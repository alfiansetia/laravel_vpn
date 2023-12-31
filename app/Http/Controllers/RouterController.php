<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Router;
use App\Traits\CompanyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class RouterController extends Controller
{
    use CompanyTrait;
    public function index(Request $request)
    {
        $comp = $this->getCompany();
        if ($request->ajax()) {
            $data = Router::with('port.vpn:id,ip,is_active,username')->where('user_id', '=', $this->getUser()->id)->get();
            return DataTables::of($data)->toJson();
        }
        return view('router.index', compact(['comp']))->with('title', 'Data Router');
    }

    public function ping(Request $request, $id)
    {
        if ($request->ajax()) {
            $obj = Router::with('port.vpn.server')->whereRelation('port.vpn', 'user_id', '=', $this->getUser()->id)->find($id);
            if ($obj && $obj->port !== null) {
                if ($obj->port->vpn->server->is_active == 'yes') {
                    $ip = $obj->port->vpn->server->ip . ':' . $obj->port->dst;
                    $u = $obj->username;
                    $p = decrypt($obj->password);
                    $data = Router::cek_login($ip, $u, $p);
                } else {
                    $data = ['message' => 'Server Nonactive', 'data' => ''];
                }
            } else {
                $data = ['message' => 'Data Not Found / Lengkapi Data!', 'data' => ''];
            }
            return response()->json($data);
        } else {
            abort(404);
        }
    }

    // public function open(Request $request)
    // {
    //     if ($request->ajax()) {
    //         if ($request->has('router_id')) {
    //             Session::put('router_id', $request->router_id);
    //             $session = MikApi::cekSession();
    //             if ($session) {
    //                 if (MikApi::isActiveService($session)) {
    //                     $cek = MikApi::cek();
    //                     if ($cek['status']) {
    //                         $data = ['message' => 'Success Create Session Router', 'data' => route('mikapi.dashboard')];
    //                     } else {
    //                         $data = ['message' => $cek['message'], 'data' => ''];
    //                     }
    //                 } else {
    //                     $data = ['message' => 'Service VPN/Server NOT Active, Select Other VPN !', 'data' => ''];
    //                 }
    //             } else {
    //                 $data = ['message' => 'Data Router Not Found', 'data' => ''];
    //             }
    //         } else {
    //             $data = ['message' => 'Data Router Not Found', 'data' => ''];
    //         }
    //         return response()->json($data);
    //     } else {
    //         abort(404);
    //     }
    // }

    public function store(Request $request)
    {
        $count = Router::where('user_id', '=', auth()->user()->id)->count();
        if ($count < 10) {
            $this->validate($request, [
                'vpn'  => [
                    'required',
                    'integer',
                    function ($attribute, $value, $fail) {
                        $port = Port::whereRelation('vpn', 'user_id', auth()->id())->find($value);
                        if (!$port) {
                            $fail('Selected port is invalid!');
                        }
                        $port = Router::where('port_id', $value)->first();
                        if ($port) {
                            $fail('The selected port is already in use on another router!');
                        }
                    }
                ],
                'name'      => 'required|min:3|max:50',
                'username'  => 'required|min:3|max:50',
                'password'  => 'required|min:3|max:100',
                'hsname'    => 'required|min:3|max:50',
                'dnsname'   => 'required|min:3|max:50',
                'desc'      => 'nullable|max:100',
            ]);
            $router = Router::create([
                'user_id'       => auth()->id(),
                'port_id'       => $request->vpn,
                'name'          => $request->name,
                'hsname'        => $request->hsname,
                'dnsname'       => $request->dnsname,
                'username'      => $request->username,
                'password'      => encrypt($request->password),
                'desc'          => $request->desc,
            ]);
            return response()->json(['message' => "Router Created!", 'data' => $router]);
        } else {
            return response()->json(['status' => false, 'message' => 'User only limit 2 Router!', 'data' => ''], 403);
        }
    }

    public function update(Request $request, string $id)
    {
        $router = Router::where('user_id', auth()->id())->find($id);
        if (!$router) {
            return response()->json(['message' => 'Router Not Found!'], 404);
        }
        $this->validate($request, [
            'vpn'  => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($id) {
                    $port = Port::whereRelation('vpn', 'user_id', auth()->id())->find($value);
                    if (!$port) {
                        $fail('Selected port is invalid!');
                    }
                    $port = Router::where('port_id', $value)->where('id', '!=', $id)->first();
                    if ($port) {
                        $fail('The selected port is already in use on another router!');
                    }
                }
            ],
            'name'      => 'required|min:3|max:50',
            'username'  => 'required|min:3|max:50',
            'password'  => 'nullable|min:3|max:100',
            'hsname'    => 'required|min:3|max:50',
            'dnsname'   => 'required|min:3|max:50',
            'desc'      => 'nullable|max:100',
        ]);
        $param = [
            'port_id'       => $request->vpn,
            'name'          => $request->name,
            'hsname'        => $request->hsname,
            'dnsname'       => $request->dnsname,
            'username'      => $request->username,
            'desc'          => $request->desc,
        ];
        if ($request->filled('password')) {
            $param['password'] = encrypt($request->password);
        }
        $router->update($param);
        return response()->json(['message' => "Router Update!", 'data' => $router]);
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $router = Router::with('port.vpn:id,expired,ip,is_active,is_trial,username,server_id', 'port.vpn.server:id,name')->where('user_id', '=', $this->getUser()->id)->find($id);
            if (!$router) {
                return response()->json(['message' => 'Router Not Found!'], 404);
            }
            return response()->json(['message' => '', 'data' => $router]);
        } else {
            abort(404);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'id'    => 'required|array|min:1',
                'id.*'  => 'required|integer|exists:routers,id',
            ]);
            $deleted = 0;
            foreach ($request->id as $id) {
                $model = Router::where('user_id', '=', $this->getUser()->id)->findOrFail($id);
                $model->delete();
                if ($model) {
                    $deleted++;
                }
            }
            $data = ['message' => 'Success Delete : ' . $deleted . ' & Fail : ' . (count($request->id) - $deleted), 'data' => ''];
            return response()->json($data);
        } else {
            abort(404);
        }
    }

    public function destroy(Request $request, string $id)
    {
        if ($request->ajax()) {
            $data = Router::where('user_id', '=', $this->getUser()->id)->find($id);
            if (!$data) {
                return response()->json(['message' => 'Data Not Found!'], 404);
            }
            $data->delete();
            return response()->json(['message' => 'Success Delete Data']);
        } else {
            abort(404);
        }
    }
}
