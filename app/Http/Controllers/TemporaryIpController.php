<?php

namespace App\Http\Controllers;

use App\Models\TemporaryIp;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class TemporaryIpController extends Controller
{
    use CrudTrait;

    public function __construct()
    {
        $this->middleware('is.admin');
        $this->model = TemporaryIp::class;
        $this->with = ['server:id,name'];
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
            $result = $data->with('server:id,name');
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
            'server'    => 'required|exists:servers,id',
            'ip'        => [
                'required', 'ip',
                Rule::unique('vpns')->where(function ($query) use ($request) {
                    return $query->where('ip', $request->input('ip'))
                        ->where('server_id', $request->input('server'));
                })
            ],
            'web'       => 'required|integer|gt:0',
            'api'       => 'required|integer|gt:0',
            'win'       => 'required|integer|gt:0',
        ]);
        $temp = TemporaryIp::create([
            'server_id' => $request->input('server'),
            'ip'        => $request->input('ip'),
            'web'       => $request->input('web'),
            'api'       => $request->input('api'),
            'win'       => $request->input('win'),
        ]);
        return response()->json(['message' => 'Success Insert Data', 'data' => $temp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TemporaryIp $temporaryIp)
    {
        $this->validate($request, [
            'server'    => 'required|exists:servers,id',
            'ip'        => [
                'required', 'ip',
                Rule::unique('vpns')->where(function ($query) use ($request) {
                    return $query->where('ip', $request->input('ip'))
                        ->where('server_id', $request->input('server'));
                })->ignore($temporaryIp->id)
            ],
            'web'       => 'required|integer|gt:0',
            'api'       => 'required|integer|gt:0',
            'win'       => 'required|integer|gt:0',
        ]);
        $temporaryIp->update([
            'server_id' => $request->input('server'),
            'ip'        => $request->input('ip'),
            'web'       => $request->input('web'),
            'api'       => $request->input('api'),
            'win'       => $request->input('win'),
        ]);
        return response()->json(['message' => 'Success Update Data', 'data' => '']);
    }
}
