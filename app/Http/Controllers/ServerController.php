<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Server;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServerController extends Controller
{
    use CrudTrait;

    private $comp;

    public function __construct()
    {
        $this->middleware('roleAdmin');
        $this->comp = Company::first();
        $this->model = Server::class;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Server::query();
            if ($request->filled('name')) {
                $data->where('name', 'like', "%{$request->name}%");
            }
            $result = $data->get();
            if (!isAdmin()) {
                $result->makeHidden(['port', 'count_ip', 'last_ip', 'last_port']);
            }
            return DataTables::of($result)->toJson();
        }
        $comp = $this->comp;
        return view('server.index', compact(['comp']))->with('title', 'Data Server');
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
            'last_ip'       => 'required|integer|gte:0',
            'price'         => 'required|integer|gte:0',
            'count_ip'      => 'required|integer|gte:0',
            'last_port'     => 'required|integer|gte:0',
            'port'          => 'required|integer|gte:0',
            'is_active'     => 'required|in:yes,no',
        ]);
        $server = Server::create([
            'name'       => $request->name,
            'username'   => $request->username,
            'password'   => encrypt($request->password),
            'ip'         => $request->ip,
            'domain'     => $request->domain,
            'netwatch'   => $request->netwatch,
            'location'   => $request->location,
            'sufiks'     => $request->sufiks,
            'port'       => $request->port,
            'last_ip'    => $request->last_ip,
            'price'      => $request->price,
            'count_ip'   => $request->count_ip,
            'last_port'  => $request->last_port,
            'is_active'  => $request->is_active,
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
            'username'      => 'required|min:4|max:100',
            'password'      => 'nullable|min:5|max:100',
            'ip'            => 'required|ip',
            'domain'        => 'required',
            'netwatch'      => 'required|ip',
            'location'      => 'required|min:3|max:20',
            'sufiks'        => 'nullable|max:20',
            'last_ip'       => 'required|integer|gte:0',
            'price'         => 'required|integer|gte:0',
            'count_ip'      => 'required|integer|gte:0',
            'last_port'     => 'required|integer|gte:0',
            'port'          => 'required|integer|gte:0',
            'is_active'     => 'required|in:yes,no',
        ]);

        $param = [
            'name'       => $request->name,
            'username'   => $request->username,
            'ip'         => $request->ip,
            'domain'     => $request->domain,
            'netwatch'   => $request->netwatch,
            'location'   => $request->location,
            'sufiks'     => $request->sufiks,
            'port'       => $request->port,
            'last_ip'    => $request->last_ip,
            'price'      => $request->price,
            'count_ip'   => $request->count_ip,
            'last_port'  => $request->last_port,
            'is_active'  => $request->is_active,
        ];
        if ($request->filled('password')) {
            $param['password'] = encrypt($request->password);
        }
        $server->update($param);
        return response()->json(['message' => 'Success Update Data', 'data' => '']);
    }


    public function ping(Request $request, Server $server)
    {
        if ($request->ajax()) {
            $server = Server::find($server->id);
            if ($server) {
                $ip = ($server->ip . ($server->port != 0 ? (':' . $server->port) : ''));
                $u = $server->username;
                $p = decrypt($server->password);
                $data = Server::cek_login($ip, $u, $p);
            } else {
                $data = ['message' => 'Data Not Found!', 'data' => ''];
            }
            return response()->json($data);
        } else {
            abort(404);
        }
    }
}
