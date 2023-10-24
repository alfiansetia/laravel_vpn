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
            'name'      => 'required|unique:servers,name',
            'ip'        => 'required|ip',
            'domain'    => 'required|min:3|max:20|url',
            'netwatch'  => 'required|ip',
            'location'  => 'required|min:3|max:20',
            'sufiks'    => 'required|min:3|max:20',
            'last_ip'   => 'required|integer',
            'price'     => 'required|integer',
            'count_ip'  => 'required|integer',
            'last_port' => 'required|integer',
            'is_active' => 'required|in:yes,no',
            'type'      => 'required|in:paid,free',
            'time'      => 'required_if:type,free|integer',
            'api'       => 'required|in:active,nonactive',
        ]);
        $server = Server::create([
            'name'       => $request->name,
            'ip'         => $request->ip,
            'domain'     => $request->domain,
            'netwatch'   => $request->netwatch,
            'location'   => $request->location,
            'sufiks'     => $request->sufiks,
            'port'       => $request->port ?? 0,
            'last_ip'    => $request->last_ip,
            'price'      => $request->price,
            'count_ip'   => $request->count_ip,
            'last_port'  => $request->last_port,
            'is_active'  => $request->is_active,
            'type'       => $request->type,
            'time_free'  => $request->time,
            'api'        => $request->api,
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
            'ip'            => 'required',
            'domain'        => 'required',
            'netwatch'      => 'required',
            'location'      => 'required|min:3|max:20',
            'sufiks'        => 'required|min:3|max:20',
            'last_ip'       => 'required',
            'price'         => 'required',
            'count_ip'      => 'required',
            'last_port'     => 'required',
            'account'       => 'required',
            'is_active'     => 'required',
            'type'          => 'required',
            'time'          => 'required',
            'api'           => 'required',
        ]);

        $server->update([
            'name'       => $request->name,
            'ip'         => $request->ip,
            'domain'     => $request->domain,
            'netwatch'   => $request->netwatch,
            'location'   => $request->location,
            'sufiks'     => $request->sufiks,
            'port'       => $request->port == NULL ? 0 : $request->port,
            'last_ip'    => $request->last_ip,
            'price'      => $request->price,
            'count_ip'   => $request->count_ip,
            'last_port'  => $request->last_port,
            'is_active'  => $request->is_active,
            'type'       => $request->type,
            'time_free'  => $request->time,
            'api'        => $request->api,
        ]);
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
