<?php

namespace App\Http\Controllers;

use App\Models\TemporaryIp;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TemporaryIpController extends Controller
{
    use CrudTrait;

    public function __construct()
    {
        $this->middleware('is.admin');
        $this->model = TemporaryIp::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TemporaryIp::query();
            if ($request->filled('ip')) {
                $data->where('ip', 'like', "%{$request->ip}%");
            }
            $result = $data;
            return DataTables::of($result)->toJson();
        }
        return view('temp.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ip'    => 'required|ip|unique:vpns,ip',
            'web'   => 'required|integer|gt:0',
            'api'   => 'required|integer|gt:0',
            'win'   => 'required|integer|gt:0',
        ]);
        $temp = TemporaryIp::create([
            'ip'    => $request->input('ip'),
            'web'   => $request->input('web'),
            'api'   => $request->input('api'),
            'win'   => $request->input('win'),
        ]);
        return response()->json(['message' => 'Success Insert Data', 'data' => $temp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TemporaryIp $temporaryIp)
    {
        $this->validate($request, [
            'ip'    => 'required|ip|unique:vpns,ip,' . $temporaryIp->ip,
            'web'   => 'required|integer|gt:0',
            'api'   => 'required|integer|gt:0',
            'win'   => 'required|integer|gt:0',
        ]);
        $temporaryIp->update([
            'ip'    => $request->input('ip'),
            'web'   => $request->input('web'),
            'api'   => $request->input('api'),
            'win'   => $request->input('win'),
        ]);
        return response()->json(['message' => 'Success Update Data', 'data' => '']);
    }
}
