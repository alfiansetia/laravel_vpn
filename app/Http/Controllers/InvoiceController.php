<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Vpn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
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
            'bank'  => 'required|exists:banks,id',
            'vpn'   => 'required|exists:vpns,id',
            'from'  => 'required|date_format:Y-m-d',
            'to'    => 'required|date_format:Y-m-d',
            'total' => 'required|integer|gt:0',
        ]);
        $user = auth()->user();
        $date = date('Y-m-d');
        $date_parse = Carbon::parse($date);
        $count = Invoice::whereDate('date', $date_parse)->count() ?? 0;
        $number = 'INV' . date('ymd', strtotime($date)) . str_pad(($count + 1), 3, 0, STR_PAD_LEFT);
        Invoice::create([
            'number'    => $number,
            'date'      => date('Y-m-d H:i:s'),
            'user_id'   => $user->id,
            'bank_id'   => $request->bank,
            'vpn_id'    => $request->vpn,
            'from'      => $request->from,
            'to'        => $request->to,
            'total'     => $request->total,
        ]);
        return response()->json(['message' => 'Success Insert Data', 'data' => []]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
