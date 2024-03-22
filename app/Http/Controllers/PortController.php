<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Vpn;
use App\Services\PortApiServices;
use App\Traits\CompanyTrait;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PortController extends Controller
{
    use CompanyTrait, CrudTrait;

    public function __construct()
    {
        $this->model = Port::class;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Port::query();
            if (isAdmin()) {
                $data->with('vpn.server');
            } else {
                $data->with('vpn:id,ip,is_active,username,server_id', 'vpn.server:id,domain,ip,location,name,netwatch,paid,price')->whereRelation('vpn', 'user_id', '=', auth()->user()->id);
            }
            $result = $data->orderBy('vpn_id', 'ASC');
            return DataTables::of($result)->toJson();
        } else {
            if (isAdmin()) {
                return view('port.index');
            } else {
                abort(404);
            }
        }
    }

    public function getByUser(Request $request)
    {
        if ($request->ajax()) {
            $data = Port::with('vpn:id,ip,is_active,username,server_id', 'vpn.server:id,domain,ip,location,name,netwatch,price,is_active')
                ->whereRelation('vpn', 'is_active', '=', 'yes')
                // ->whereRelation('vpn.server', 'is_active', '=', 'yes')
                ->whereRelation('vpn', 'user_id', '=', auth()->id());
            return DataTables::of($data)->toJson();
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'vpn'    => [
                'required',
                'integer',
                'exists:vpns,id',
                function ($attribute, $value, $fail) {
                    $vpn = Vpn::where('id', $value)->where('is_active', 'yes')->first();
                    if (!$vpn) {
                        $fail('The selected Vpn is not active.');
                    }
                }
            ],
            'dst'    => 'required|integer|gt:1|lt:10000',
            'to'     => 'required|integer|gt:1|lt:10000',
            'sync'   => 'nullable|in:on',
        ]);

        DB::beginTransaction();
        try {
            $data = [];
            if ($request->sync == 'on') {
                $vpn = Vpn::with('server')->find($request->vpn);
                $param = [
                    'username'  => $vpn->username,
                    'ip'        => $vpn->ip,
                    'dst'       => $request->dst,
                    'to'        => $request->to,
                ];
                $service  = new PortApiServices($vpn->server);
                $data = $service->store($param);
            }
            Port::create([
                'vpn_id'    => $request->vpn,
                'dst'       => $request->dst,
                'to'        => $request->to,
            ]);
            DB::commit();
            return response()->json(['message' => 'Success Update Data', 'data' => $data]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage(), 'data' => []], 500);
        }
    }

    public function show(Request $request, Port $port)
    {
        if ($request->ajax()) {
            return response()->json([
                'data'      => $port->load('vpn', 'vpn.server'),
                'message'   => ''
            ]);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, Port $port)
    {
        $this->validate($request, [
            'dst'    => 'required|integer|gt:1|lt:10000',
            'to'     => 'required|integer|gt:1|lt:10000',
            'sync'   => 'nullable|in:on',
        ]);

        DB::beginTransaction();
        try {
            $param = [
                'dst'   => $request->dst,
                'to'    => $request->to,
            ];
            $data = [];
            if ($request->sync == 'on') {
                $service  = new PortApiServices($port->vpn->server);
                $data = $service->update($port, $param);
            }
            $port->update($param);
            DB::commit();
            return response()->json(['message' => 'Success Update Data', 'data' => $data]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage(), 'data' => []], 500);
        }
    }

    public function destroy(Request $request, Port $port)
    {
        DB::beginTransaction();
        try {
            $data = [];
            $service  = new PortApiServices($port->vpn->server);
            $data = $service->destroy($port);
            $port->delete();
            DB::commit();
            return response()->json(['message' => 'Success Update Data', 'data' => $data]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage(), 'data' => []], 500);
        }
    }
}
