<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{

    public function paginate(Request $request)
    {
        $user_id = auth()->id();
        $filters = $request->only(['number', 'bank_id', 'user_id', 'status']);
        $query = Invoice::query()->with(['user', 'bank', 'vpn'])->filter($filters);
        if (!isAdmin()) {
            $query->whereRelation('vpn', 'user_id', $user_id);
            $query->where('user_id', $user_id);
        }
        $data = $query->paginate(intval($request->limit ?? 10));
        return InvoiceResource::collection($data);
    }

    public function index(Request $request)
    {
        $user_id = auth()->id();
        $filters = $request->only(['number', 'bank_id', 'user_id', 'status']);
        $query = Invoice::query()->with(['user', 'bank', 'vpn'])->filter($filters);
        if (!isAdmin()) {
            $query->whereRelation('vpn', 'user_id', $user_id);
            $query->where('user_id', $user_id);
        }
        return DataTables::eloquent($query)->setTransformer(function ($item) {
            return InvoiceResource::make($item)->resolve();
        })->toJson();
    }

    public function show(Invoice $invoice)
    {
        if (!isAdmin() && auth()->id != $invoice->user_id) {
            return $this->send_response_unauthorize();
        }
        return  new InvoiceResource($invoice->load(['user', 'bank', 'vpn']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user'  => 'required|exists:users,id',
            'bank'  => 'required|exists:banks,id',
            'vpn'   => 'required|exists:vpns,id',
            'from'  => 'required|date_format:Y-m-d',
            'to'    => 'required|date_format:Y-m-d',
            'total' => 'required|integer|gt:0',
            'desc'  => 'nullable|max:200',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);
        $date = date('Y-m-d');
        $date_parse = Carbon::parse($date);
        $count = Invoice::whereDate('date', $date_parse)->count() ?? 0;
        $number = 'INV' . date('ymd', strtotime($date)) . str_pad(($count + 1), 3, 0, STR_PAD_LEFT);
        $img = null;
        if ($files = $request->file('image')) {
            $destinationPath = public_path('/images/invoice/');
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 755, true);
            }
            $img = 'invoice_' . $number . '_' . date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $img);
        }
        $invoice = Invoice::create([
            'number'    => $number,
            'date'      => date('Y-m-d H:i:s'),
            'user_id'   => $request->user,
            'bank_id'   => $request->bank,
            'vpn_id'    => $request->vpn,
            'from'      => $request->from,
            'to'        => $request->to,
            'total'     => $request->total,
            'desc'      => $request->desc,
            'image'     => $img,
        ]);
        return $this->send_response('Success Insert Data', new InvoiceResource($invoice));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        if (!isAdmin() && auth()->id != $invoice->user_id) {
            return $this->send_response_unauthorize();
        }
        $validate = [
            'user'  => 'required|exists:users,id',
            'bank'  => 'required|exists:banks,id',
            'vpn'   => 'required|exists:vpns,id',
            'from'  => 'required|date_format:Y-m-d',
            'to'    => 'required|date_format:Y-m-d',
            'total' => 'required|integer|gt:0',
            'desc'  => 'nullable|max:200',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ];
        if ($invoice->status != 'unpaid') {
            $validate = [
                'desc'  => 'nullable|max:200',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            ];
        }
        $this->validate($request, $validate);
        $img = $invoice->getRawOriginal('image');
        if ($files = $request->file('image')) {
            $destinationPath = public_path('/images/invoice/');
            if (!empty($img) && file_exists($destinationPath . $img)) {
                File::delete($destinationPath . $img);
            }
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 755, true);
            }
            $img = 'invoice_' . $invoice->number . '_' . date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $img);
        }
        $param  = [
            'user_id'   => $request->user,
            'bank_id'   => $request->bank,
            'vpn_id'    => $request->vpn,
            'from'      => $request->from,
            'to'        => $request->to,
            'total'     => $request->total,
            'desc'      => $request->desc,
            'image'     => $img,
        ];
        if ($invoice->status != 'unpaid') {
            $param = [
                'desc'  => $request->desc,
                'image' => $img,
            ];
        }
        $invoice->update($param);
        return $this->send_response('Success Update Data', new InvoiceResource($invoice));
    }

    public function destroy(Request $request, Invoice $invoice)
    {
        $this->validate($request, [
            'status' => 'required|in:paid,cancel'
        ]);
        $reqstatus = $request->status;
        $invstatus = $invoice->status;
        if (
            $reqstatus == $invstatus ||
            ($reqstatus == 'paid' && $invstatus != 'unpaid') ||
            ($reqstatus == 'cancel' && $invstatus != 'paid' && $invstatus == 'cancel')
        ) {
            return $this->send_response_unauthorize('Status Already : ' . $invoice->status);
        }
        $invoice->update([
            'status' => $reqstatus,
        ]);

        return $this->send_response('Success Update Status : ' . $invoice->number . ' to : ' . $reqstatus, new InvoiceResource($invoice));
    }
}
