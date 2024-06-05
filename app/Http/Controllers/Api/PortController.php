<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortResource;
use App\Models\Port;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PortController extends Controller
{
    public function paginate(Request $request)
    {
        $query = Port::query()->whereRelation('vpn', 'user_id', auth()->id())
            ->whereRelation('vpn', 'is_active', 'yes');
        if ($request->filled('username')) {
            $query->WhereRelation('vpn', 'username', 'like', "%$request->username%");
        }
        $data = $query->with(['vpn:id,username,server_id,is_active', 'vpn.server:id,name'])->paginate(10)->withQueryString();
        return PortResource::collection($data);
    }

    public function index(Request $request)
    {
        $data = Port::query();
        $data->with(['vpn:id,ip,is_active,username,server_id', 'vpn.server:id,name'])
            ->whereRelation('vpn', 'user_id', auth()->id());
        $result = $data->orderBy('vpn_id', 'ASC');
        return DataTables::of(PortResource::collection($result))->toJson();
    }


    public function show(string $id)
    {
        $port = Port::whereRelation('vpn', 'user_id', auth()->id())->find($id);
        if (!$port) {
            return response()->json(['message' => 'Data Not Found!'], 404);
        }
        return new PortResource($port->load('vpn.server'));
    }
}
