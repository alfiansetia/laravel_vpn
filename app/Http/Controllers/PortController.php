<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Vpn;
use App\Traits\CompanyTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PortController extends Controller
{
    use CompanyTrait;

    public function index(Request $request)
    {
        $comp = $this->getCompany();
        if ($request->ajax()) {
            $data = Port::query();
            if (isAdmin()) {
                $data->with('vpn.server');
            } else {
                $data->with('vpn:id,ip,is_active,username,server_id', 'vpn.server:id,domain,ip,location,name,netwatch,paid,price')->whereRelation('vpn', 'user_id', '=', auth()->user()->id);
            }
            return DataTables::of($data)->toJson();
        } else {
            if (isAdmin()) {
                return view('port.index', compact(['comp']))->with('title', 'Data Port');
            } else {
                abort(404);
            }
        }
    }

    public function getByUser(Request $request)
    {
        if ($request->ajax()) {
            $data = Port::with('vpn:id,ip,is_active,username,server_id', 'vpn.server:id,domain,ip,location,name,netwatch,type,price,is_active,api')
                ->whereRelation('vpn', 'is_active', '=', 'yes')
                // ->whereRelation('vpn.server', 'is_active', '=', 'yes')
                ->whereRelation('vpn', 'user_id', '=', auth()->user()->id)
                ->get();
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
            'sync'          =>  [
                'required',
                'in:yes,no',
                function ($attribute, $value, $fail) use ($request) {
                    $vpn = Vpn::with('server')->find($request->input('vpn'));
                    if ($vpn->server->api == 'active') {
                        $vpnActive = true;
                    } else {
                        $vpnActive = false;
                    }
                    if ($value === 'yes' && !$vpnActive) {
                        $fail('API Server OFF! Sync can only be "yes" when API server is active.');
                    }
                },
            ],
        ]);
        $createApi['status'] = true;
        if ($request->sync == 'yes') {
            $vpn = Vpn::with('server')->find($request->vpn);
            $ip = ($vpn->server->ip . ($vpn->server->port != 0 ? (':' . $vpn->server->port) : ''));
            $u = $vpn->server->username;
            $p = decrypt($vpn->server->password);
            $param = [
                'server'    => [
                    'ip'    => $ip,
                    'user'  => $u,
                    'pass'  => $p,
                ],
                'data'      => [
                    'username'  => $vpn->username,
                    'ip'        => $vpn->ip,
                    'dst'       => $request->dst,
                    'to'        => $request->to
                ],
            ];
            $createApi = Port::createApi($param);
        }
        if ($createApi['status']) {
            $port = Port::create([
                'vpn_id'    => $request->vpn,
                'dst'       => $request->dst,
                'to'        => $request->to,
            ]);
            if ($port) {
                $data = ['status' => true, 'message' => 'Success Insert Data', 'data' => ''];
            } else {
                $data = ['status' => false, 'message' => 'Failed Insert Data', 'data' => ''];
            }
        } else {
            $data = $createApi;
        }
        return response()->json($data);
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
            'sync'   =>  [
                'required',
                'in:yes,no',
                function ($attribute, $value, $fail) use ($port) {
                    $port = Port::with('vpn.server')->find($port->id);
                    if ($port->vpn->server->api == 'active') {
                        $vpnActive = true;
                    } else {
                        $vpnActive = false;
                    }
                    if ($value === 'yes' && !$vpnActive) {
                        $fail('API Server OFF! Sync can only be "yes" when API server is active.');
                    }
                },
            ],
        ]);
        $port = Port::with('vpn.server')->findOrFail($port->id);
        $updateApi['status'] = true;
        if ($request->sync == 'yes') {
            $ip = ($port->vpn->server->ip . ($port->vpn->server->port != 0 ? (':' . $port->vpn->server->port) : ''));
            $u = $port->vpn->server->username;
            $p = decrypt($port->vpn->server->password);
            $param = [
                'server'    => [
                    'ip'    => $ip,
                    'user'  => $u,
                    'pass'  => $p,
                ],
                'old' => [
                    'dst' => $port->dst,
                    'to'  => $port->to,
                ],
                'data'      => [
                    'username'  => $port->vpn->username,
                    'ip'        => $port->vpn->ip,
                    'dst'       => $request->dst,
                    'to'        => $request->to
                ],
            ];
            $updateApi = Port::updateApi($param);
        }
        if ($updateApi['status']) {
            $port->update([
                'dst'       => $request->dst,
                'to'        => $request->to,
            ]);
            if ($port) {
                $data = ['status' => true, 'message' => 'Success Update Data', 'data' => ''];
            } else {
                $data = ['status' => false, 'message' => 'Failed Update Data', 'data' => ''];
            }
        } else {
            $data = $updateApi;
        }
        return response()->json($data);
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|array|min:1'
        ]);
        foreach ($request->id as $id) {
            $port = Port::with('vpn.server')->findOrFail($id);
            $ip = ($port->vpn->server->ip . ($port->vpn->server->port != 0 ? (':' . $port->vpn->server->port) : ''));
            $u = $port->vpn->server->username;
            $p = decrypt($port->vpn->server->password);
            $param = [
                'server'    => [
                    'ip'    => $ip,
                    'user'  => $u,
                    'pass'  => $p,
                ],
                'username'  => $port->vpn->username,
                'dst'       => $port->dst,
                'to'        => $port->to,
            ];
            $api = Port::deleteApi($param);
            if ($api['status']) {
                $port->delete();
                if ($port) {
                    $data = ['status' => true, 'message' => 'Success Delete Data', 'data' => ''];
                } else {
                    $data = ['status' => false, 'message' => 'Failed Delete Data', 'data' => ''];
                }
            } else {
                $data = $api;
            }
        }
        return response()->json($data);
    }
}
