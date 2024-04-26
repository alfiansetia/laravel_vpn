<?php

namespace App\Http\Controllers;

use App\Models\BalanceHistory;
use App\Models\Topup;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TopupController extends Controller
{
    use CrudTrait;

    public function __construct()
    {
        $this->model = Topup::class;
        $this->with = ['user:id,name,email', 'bank:id,name,acc_name,acc_number'];
        $this->middleware(['is.admin'])->only(['update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($request->ajax()) {
            $data = Topup::query();
            if ($request->filled('number')) {
                $data->where('number', 'like', "%{$request->number}%");
            }
            if ($user->is_admin()) {
                $result = $data->with('user', 'bank');
            } else {
                $data->where('user_id', $user->id);
                $result = $data->with('user:id,name,email', 'bank:id,name,acc_name');
            }
            return DataTables::of($result)->toJson();
        }
        if ($user->is_admin()) {
            return view('topup.index');
        } else {
            return view('topup.index_user');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $validate  = [
            'bank'      => 'required|exists:banks,id',
            'amount'    => 'required|integer|gt:0|lte:500000',
            'desc'      => 'nullable|max:200',
        ];
        if ($user->is_admin()) {
            $validate['user'] = 'required|exists:users,id';
        } else {
            $current = Topup::query()->where('user_id', $user->id)->where('status', 'pending')->count() ?? 0;
            if ($current > 0) {
                return response()->json(['message' => $current . ' Pending Topup already exists!'], 403);
            }
        }
        $this->validate($request, $validate);
        $date = date('Y-m-d');
        $date_parse = Carbon::parse($date);
        $count = Topup::whereDate('date', $date_parse)->count() ?? 0;
        $number = 'INV' . date('ymd', strtotime($date)) . str_pad(($count + 1), 3, 0, STR_PAD_LEFT);
        $param = [
            'number'    => $number,
            'date'      => date('Y-m-d H:i:s'),
            'user_id'   => $user->id,
            'bank_id'   => $request->bank,
            'amount'    => $request->amount,
            'desc'      => $request->desc,
        ];
        if ($user->is_admin()) {
            $param['user_id'] = $request->user;
        }
        Topup::create($param);
        return response()->json(['message' => 'Success Insert Data', 'data' => []]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topup $topup)
    {
        $validate = [
            'user'      => 'required|exists:users,id',
            'bank'      => 'required|exists:banks,id',
            'amount'    => 'required|integer|gt:0|lte:500000',
            'desc'      => 'nullable|max:200',
        ];
        if ($topup->status != 'pending') {
            $validate = [
                'desc'  => 'nullable|max:200',
            ];
        }
        $this->validate($request, $validate);
        $param  = [
            'user_id'   => $request->user,
            'bank_id'   => $request->bank,
            'amount'    => $request->amount,
            'desc'      => $request->desc,
        ];
        if ($topup->status != 'pending') {
            $param = [
                'desc'  => $request->desc,
            ];
        }
        $topup->update($param);
        return response()->json(['message' => 'Success Update Data', 'data' => []]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Topup $topup)
    {
        $this->validate($request, [
            'status' => 'required|in:done,cancel'
        ]);
        DB::beginTransaction();
        try {

            $reqstatus = $request->status;
            $topstatus = $topup->status;
            if (
                $reqstatus == $topstatus ||
                ($reqstatus == 'done' && $topstatus != 'pending') ||
                ($reqstatus == 'cancel' && $topstatus != 'done' && $topstatus == 'cancel')
            ) {
                return response()->json([
                    'message' => 'Status Already : ' . $topup->status
                ], 403);
            }
            $amount = $topup->amount;
            $user = $topup->user;
            $user_balance = $user->balance;
            if ($topstatus == 'pending' && $reqstatus == 'done') {
                $user->update([
                    'balance' => $user_balance + $amount,
                ]);
                BalanceHistory::create([
                    'date'      => date('Y-m-d H:i:s'),
                    'user_id'   => $topup->user_id,
                    'amount'    => $amount,
                    'type'      => 'plus',
                    'before'    => $user_balance,
                    'after'     => $user_balance + $amount,
                    'desc'      => 'Topup ' . $topup->number,
                ]);
            }
            if ($topstatus == 'done' && $reqstatus == 'cancel') {
                if ($user_balance < $amount) {
                    throw new Exception('Balance user not enough!');
                }
                $user->update([
                    'balance' => $user_balance - $amount,
                ]);
                BalanceHistory::create([
                    'date'      => date('Y-m-d H:i:s'),
                    'user_id'   => $topup->user_id,
                    'amount'    => $amount,
                    'type'      => 'min',
                    'before'    => $user_balance,
                    'after'     => $user_balance - $amount,
                    'desc'      => 'Cancel topup ' . $topup->number,
                ]);
            }
            $topup->update([
                'status' => $reqstatus,
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Success Update Status : ' . $topup->number . ' to : ' . $reqstatus
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed Update Status : ' . $th->getMessage()
            ], 500);
        }
    }
}
