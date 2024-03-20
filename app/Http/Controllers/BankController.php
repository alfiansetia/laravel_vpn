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
        $this->middleware('is.admin');
        $this->model = Bank::class;
    }

    public function paginate(Request $request)
    {
        $perpage = 10;
        if ($request->filled('perpage') && $request->perpage > 10 && is_numeric($request->perpage)) {
            $perpage = $request->perpage;
        }
        $data = Bank::query();
        if ($request->filled('name')) {
            $data->where('name', 'like', "%{$request->name}%");
        }
        $result = $data->paginate($perpage);
        return $result;
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
            'is_active'     => 'nullable|in:on',
        ]);
        $bank = Bank::create([
            'name'          => $request->name,
            'acc_name'      => $request->acc_name,
            'acc_number'    => $request->acc_number,
            'is_active'     => $request->input('is_active') == 'on' ? 'yes' : 'no',
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
            'is_active'     => 'nullable|in:on',
        ]);
        $bank->update([
            'name'          => $request->name,
            'acc_name'      => $request->acc_name,
            'acc_number'    => $request->acc_number,
            'is_active'     => $request->input('is_active') == 'on' ? 'yes' : 'no',
        ]);
        return response()->json(['message' => 'Success Update Data', 'data' => '']);
    }
}
