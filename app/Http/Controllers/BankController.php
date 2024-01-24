<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{

    use CrudTrait;

    public function __construct()
    {
        $this->middleware('roleAdmin');
        $this->model = Bank::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bank::query();
            if ($request->filled('name')) {
                $data->where('name', 'like', "%{$request->name}%");
            }
            $result = $data;
            return DataTables::of($result)->toJson();
        }
        return view('bank.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|max:100',
            'acc_name'      => 'required|max:100',
            'acc_number'    => 'required|max:100',
        ]);
        $bank = Bank::create([
            'name'          => $request->name,
            'acc_name'      => $request->acc_name,
            'acc_number'    => $request->acc_number,
        ]);
        return response()->json(['message' => 'Success Insert Data', 'data' => $bank]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        $this->validate($request, [
            'name'          => 'required|max:100',
            'acc_name'      => 'required|max:100',
            'acc_number'    => 'required|max:100',
        ]);
        $bank->update([
            'name'          => $request->name,
            'acc_name'      => $request->acc_name,
            'acc_number'    => $request->acc_number,
        ]);
        return response()->json(['message' => 'Success Update Data', 'data' => '']);
    }
}
