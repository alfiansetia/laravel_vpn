<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Server;
use App\Services\ServerApiServices;
use App\Traits\CrudTrait;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServerController extends Controller
{
    use CrudTrait;

    public function __construct()
    {
        $this->middleware('is.admin');
        $this->model = Server::class;
    }

    public function paginate(Request $request)
    {
        $perpage = 10;
        if ($request->filled('perpage') && $request->perpage > 10 && is_numeric($request->perpage)) {
            $perpage = $request->perpage;
        }
        $data = Server::query();
        if ($request->filled('name')) {
            $data->where('name', 'like', "%{$request->name}%");
        }
        $result = $data->paginate($perpage);
        return $result;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Server::query();
            if ($request->filled('name')) {
                $data->where('name', 'like', "%{$request->name}%");
            }
            $result = $data;
            if (!isAdmin()) {
                $result->makeHidden(['port', 'username', 'count_ip', 'last_ip', 'last_port']);
            }
            return DataTables::of($result)->toJson();
        }
        return view('server.index',);
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
            // 'count_ip'      => 'required|integer|gte:0',
            // 'last_port'     => 'required|integer|gte:0',
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
            // 'count_ip'      => $request->count_ip,
            // 'last_port'     => $request->last_port,
            'is_active'     => $request->active == 'on' ? 'yes' : 'no',
            'is_available'  => $request->available == 'on' ? 'yes' : 'no',
        ]);
        if ($server) {
            return response()->json(['message' => 'Success Insert Data', 'data' => '']);
        } else {
            return response()->json(['message' => 'Failed Insert Data', 'data' => '']);
        }
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
            // 'count_ip'      => 'required|integer|gte:0',
            // 'last_port'     => 'required|integer|gte:0',
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
            // 'count_ip'      => $request->count_ip,
            // 'last_port'     => $request->last_port,
            'is_active'     => $request->active == 'on' ? 'yes' : 'no',
            'is_available'  => $request->available == 'on' ? 'yes' : 'no',
        ];
        if ($request->filled('password')) {
            $param['password'] = encrypt($request->password);
        }
        if ($request->filled('username')) {
            $param['username'] = $request->username;
        }
        $server->update($param);
        return response()->json(['message' => 'Success Update Data', 'data' => '']);
    }


    public function ping(Request $request, Server $server)
    {
        if ($request->ajax()) {
            $service  = new ServerApiServices($server);
            try {
                $service->ping();
                return response()->json(['message' => 'Connected']);
            } catch (Exception $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        } else {
            abort(404);
        }
    }
}
