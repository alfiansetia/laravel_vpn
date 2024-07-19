<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServerResource;
use App\Models\Server;
use App\Services\ServerApiServices;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServerController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin')->except(['index', 'paginate']);
    }

    public function paginate(Request $request)
    {
        $filters = $request->only(['name', 'ip', 'domain', 'is_active', 'is_available']);
        $query = Server::query()->filter($filters)->paginate(intval($request->limit ?? 10));
        return ServerResource::collection($query);
    }

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'ip', 'domain', 'is_active', 'is_available']);
        $query = Server::query()->filter($filters);
        return DataTables::eloquent($query)->setTransformer(function ($item) {
            return ServerResource::make($item)->resolve();
        })->toJson();
    }

    public function show(Server $server)
    {
        return new ServerResource($server);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|unique:servers,name',
            'username'      => 'required|min:4|max:100',
            'password'      => 'required|min:5|max:100',
            'ip'            => 'required|ip',
            'domain'        => 'required',
            'netwatch'      => 'required|ip',
            'location'      => 'required|min:3|max:20',
            'sufiks'        => 'nullable|max:20',
            'last_ip'       => 'required|ip',
            'price'         => 'required|integer|gte:0',
            'annual_price'  => 'required|integer|gte:0',
            'port'          => 'required|integer|gte:0',
            'active'        => 'nullable|in:on',
            'available'     => 'nullable|in:on',
        ]);
        $server = Server::create([
            'name'          => $request->name,
            'username'      => $request->username,
            'password'      => encrypt($request->password),
            'ip'            => $request->ip,
            'domain'        => $request->domain,
            'netwatch'      => $request->netwatch,
            'location'      => $request->location,
            'sufiks'        => $request->sufiks,
            'port'          => $request->port,
            'last_ip'       => $request->last_ip,
            'price'         => $request->price,
            'annual_price'  => $request->annual_price,
            'is_active'     => $request->active ?? 'no',
            'is_available'  => $request->available ?? 'no',
        ]);
        return $this->send_response('Success Insert Data', new ServerResource($server));
    }

    public function update(Request $request, Server $server)
    {
        $this->validate($request, [
            'name'          => 'required|unique:servers,name,' . $server->id,
            'username'      => 'nullable|min:4|max:100',
            'password'      => 'nullable|min:5|max:100',
            'ip'            => 'required|ip',
            'domain'        => 'required',
            'netwatch'      => 'required|ip',
            'location'      => 'required|min:3|max:20',
            'sufiks'        => 'nullable|max:20',
            'last_ip'       => 'required|ip',
            'price'         => 'required|integer|gte:0',
            'annual_price'  => 'required|integer|gte:0',
            'port'          => 'required|integer|gte:0',
            'active'        => 'nullable|in:on',
            'available'     => 'nullable|in:on',
        ]);

        $param = [
            'name'          => $request->name,
            'ip'            => $request->ip,
            'domain'        => $request->domain,
            'netwatch'      => $request->netwatch,
            'location'      => $request->location,
            'sufiks'        => $request->sufiks,
            'port'          => $request->port,
            'last_ip'       => $request->last_ip,
            'price'         => $request->price,
            'annual_price'  => $request->annual_price,
            'is_active'     => $request->active ?? 'no',
            'is_available'  => $request->available ?? 'no',
        ];
        if ($request->filled('password')) {
            $param['password'] = encrypt($request->password);
        }
        if ($request->filled('username')) {
            $param['username'] = $request->username;
        }
        $server->update($param);
        return $this->send_response('Success Update Data', new ServerResource($server));
    }

    public function destroy(Server $server)
    {
        $server->delete();
        return $this->send_response('Success Delete Data!');
    }

    public function destroy_batch(Request $request)
    {
        $this->validate($request, [
            'id'    => 'required|array|min:1',
            'id.*'  => 'required|integer|exists:servers,id',
        ]);
        $deleted = 0;
        foreach ($request->id as $id) {
            $server = Server::find($id);
            if ($server) {
                $server->delete();
                $deleted++;
            }
        }
        return $this->send_response_not_found('Success Delete : ' . $deleted . ' & Fail : ' . (count($request->id) - $deleted));
    }

    public function ping(Server $server)
    {
        $service  = new ServerApiServices($server);
        try {
            $ping = $service->ping();
            return $this->send_response('Connected!', $ping);
        } catch (Exception $e) {
            return $this->send_response($e->getMessage(), null, 500);
        }
    }
}
