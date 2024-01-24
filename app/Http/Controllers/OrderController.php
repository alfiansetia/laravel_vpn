<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Vpn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::query();
            if ($request->filled('number')) {
                $data->where('number', 'like', "%{$request->number}%");
            }
            $result = $data->with('user', 'bank');
            return DataTables::of($result)->toJson();
        }
        return view('order.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user'      => 'required|integer|exists:users,id',
            'bank'      => 'required|integer|exists:banks,id',
            'vpn'       => 'required|array|min:1',
            'total'     => 'required|array|min:1',
            'vpn.*'     => 'required|integer|exists:vpns,id',
            'total.*'   => 'required|integer|gte:1',
        ]);
        DB::beginTransaction();
        try {
            $total = 0;
            $orderItems = [];
            foreach ($request->vpn as $key => $item) {
                $vpn = Vpn::with('server')->find($item);
                $price = $vpn->server->price;
                $annual_price = $vpn->server->annual_price;
                $total += $price;
                $subtotal = $price * $request->total[$key];
                $orderItems[] = [
                    'vpn_id'    => $item,
                    'price'     => $price,
                    'total'     => $request->total[$key],
                    'subtotal'  => $subtotal,
                ];
            }
            $order = Order::create([
                'user_id'   => $request->user,
                'bank_id'   => $request->bank,
                'date'      => now(),
                'number'    => Str::random(16),
                'total'     => $total,
                'status'    => 'unpaid',
            ]);
            foreach ($orderItems as $orderItem) {
                OrderItem::create([
                    'order_id'  => $order->id,
                    'vpn_id'    => $orderItem['vpn_id'],
                    'price'     => $orderItem['price'],
                    'total'     => $orderItem['total'],
                    'subtotal'  => $orderItem['subtotal'],
                ]);
            }
            DB::commit();
            return redirect()->route('order.index')->with(['success' => 'Transaction Success!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('order.index')->with(['error' => 'Transaction Failed!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Order $order)
    {
        if ($request->ajax()) {
            $data = $order->load('order_items', 'bank', 'user');
            return response()->json(['message' => '', 'data' => $data]);
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Order $order)
    {
        if ($request->ajax()) {
            $data = $order->update([
                'status' => 'cancel'
            ]);
            return response()->json(['message' => '', 'data' => $data]);
        } else {
            abort(404);
        }
    }
}
