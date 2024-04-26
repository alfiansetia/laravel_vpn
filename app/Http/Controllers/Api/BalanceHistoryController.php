<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BalanceHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BalanceHistoryController extends Controller
{
    public function index(Request $request)
    {
        $data = BalanceHistory::query()
            ->where('user_id', auth()->id())->get();
        if ($request->dt == 'on') {
            return DataTables::of($data)->toJson();
        } else {
            return response()->json($data);
        }
    }
}
