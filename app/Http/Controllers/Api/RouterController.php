<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RouterResource;
use App\Models\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RouterController extends Controller
{
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
            return response()->json(['message' => 'Data Not Found!'], 404);
        }
        return new RouterResource($router->load('user', 'port.vpn.server'));
    }

    public function store(Request $request)
    {
        $count = Router::where('user_id', '=', auth()->user()->id)->count();
        if ($count < 2) {
            $this->validate($request, [
                'vpn_port'  => 'required', 'integer', 'exists:ports,id', function ($attribute, $value, $fail) {
                    $user = auth()->user();
                    if (!$user->vpn->pluck('port')->flatten()->pluck('id')->contains($value)) {
                        $fail('The selected VPN port is invalid.');
                    }
                },
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
                'password'      => Crypt::encrypt($request->password),
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
            return response()->json(['message' => 'Data Not Found!'], 404);
        }
        $router->delete();
        return response()->json(['message' => 'Data Deleted!']);
    }
}
