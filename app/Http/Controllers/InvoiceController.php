<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Vpn;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    use CrudTrait;

    public function __construct()
    {
        $this->model = Invoice::class;
        $this->with = ['user:id,name,email', 'vpn:id,username,server_id', 'vpn.server:id,name', 'bank:id,name,acc_name'];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Invoice::query();
            if ($request->filled('number')) {
                $data->where('number', 'like', "%{$request->number}%");
            }
            $result = $data->with('user', 'bank', 'vpn');
            return DataTables::of($result)->toJson();
        }
        return view('invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('invoice.create');
    }

    public function createVpn(Vpn $vpn)
    {
        // return view('invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
        ]);
        $date = date('Y-m-d');
        $date_parse = Carbon::parse($date);
        $count = Invoice::whereDate('date', $date_parse)->count() ?? 0;
        $number = 'INV' . date('ymd', strtotime($date)) . str_pad(($count + 1), 3, 0, STR_PAD_LEFT);
        Invoice::create([
            'number'    => $number,
            'date'      => date('Y-m-d H:i:s'),
            'user_id'   => $request->user,
            'bank_id'   => $request->bank,
            'vpn_id'    => $request->vpn,
            'from'      => $request->from,
            'to'        => $request->to,
            'total'     => $request->total,
            'desc'      => $request->desc,
        ]);
        return response()->json(['message' => 'Success Insert Data', 'data' => []]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validate = [
            'user'  => 'required|exists:users,id',
            'bank'  => 'required|exists:banks,id',
            'vpn'   => 'required|exists:vpns,id',
            'from'  => 'required|date_format:Y-m-d',
            'to'    => 'required|date_format:Y-m-d',
            'total' => 'required|integer|gt:0',
            'desc'  => 'nullable|max:200',
        ];
        if ($invoice->status != 'unpaid') {
            $validate = [
                'desc'  => 'nullable|max:200',
            ];
        }
        $this->validate($request, $validate);
        $param  = [
            'user_id'   => $request->user,
            'bank_id'   => $request->bank,
            'vpn_id'    => $request->vpn,
            'from'      => $request->from,
            'to'        => $request->to,
            'total'     => $request->total,
            'desc'      => $request->desc,
        ];
        if ($invoice->status != 'unpaid') {
            $param = [
                'desc'  => $request->desc,
            ];
        }
        $invoice->update($param);
        return response()->json(['message' => 'Success Update Data', 'data' => []]);
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
            return response()->json([
                'message' => 'Status Already : ' . $invoice->status
            ], 403);
        }
        $invoice->update([
            'status' => $reqstatus,
        ]);

        return response()->json([
            'message' => 'Success Update Status : ' . $invoice->number . ' to : ' . $reqstatus
        ]);
    }
}
