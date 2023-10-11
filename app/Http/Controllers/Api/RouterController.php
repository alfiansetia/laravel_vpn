<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RouterResource;
use App\Models\Port;
use App\Models\Router;
use App\Services\RouterApiServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RouterController extends Controller
{

    public function __construct()
    {
        // $this->middleware('checkRouterExists')->only(['ping']);
    }


    public function index(Request $request)
    {
        $limit = 10;
        if ($request->filled('limit') && is_numeric($request->limit) && $request->limit > 0) {
            $limit = $request->limit;
        }
        $data = Router::where('user_id', auth()->id())->paginate($limit)->withQueryString();
        return RouterResource::collection($data);
    }

    public function show(string $id)
    {
        $router = Router::where('user_id', auth()->id())->find($id);
        if (!$router) {
            return response()->json(['message' => 'Router Not Found!'], 404);
        }
        return new RouterResource($router->load('user', 'port.vpn.server'));
    }

    public function store(Request $request)
    {
        $count = Router::where('user_id', '=', auth()->user()->id)->count();
        if ($count < 10) {
            $this->validate($request, [
                'vpn_port'  => [
                    'required',
                    'integer',
                    function ($attribute, $value, $fail) {
                        $port = Port::whereRelation('vpn', 'user_id', auth()->id())->find($value);
                        if (!$port) {
                            $fail('Selected port is invalid!');
                        }
                    }
                ],
                'name'      => 'required|min:3|max:20',
                'username'  => 'required|min:3',
                'password'  => 'required|min:3',
                'hsname'    => 'required|min:3|max:30',
                'dnsname'   => 'required|min:3|max:30',
                'desc'      => 'nullable|max:30',
            ]);
            $router = Router::create([
                'user_id'       => auth()->user()->id,
                'port_id'       => $request->vpn_port,
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

    public function destroy(string $id)
    {
        $router = Router::where('user_id', auth()->id())->find($id);
        if (!$router) {
            return response()->json(['message' => 'Router Not Found!'], 404);
        }
        $router->delete();
        return response()->json(['message' => 'Router Deleted!']);
    }

    public function ping(string $id)
    {
        $router = Router::where('user_id', auth()->id())->find($id);
        if (!$router) {
            return response()->json(['message' => 'Router Not Found!'], 404);
        }
        if (!$router->port) {
            return response()->json(['mesage' => 'Select VPN on Router'], 422);
        }
        if ($router->port->vpn->is_active == 'no') {
            return response()->json(['mesage' => 'Your VPN Nonactive!'], 422);
        }
        if ($router->port->vpn->server->is_active == 'no') {
            return response()->json(['mesage' => 'Server OFF! Contact Admin.'], 422);
        }
        $con = new RouterApiServices($router);
        $data = $con->ping();
        return response()->json($data, $data['status'] ? 200 : 422);
    }
}
