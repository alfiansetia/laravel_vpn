<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\ServerProfileResource;
use App\Services\Mikapi\Hotspot\ServerProfileServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class ServerProfileController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        $this->setRouter($request->router, ServerProfileServices::class);
        $query = [];
        if ($request->filled('name')) {
            $query['?name'] = $request->name;
        }
        $data = $this->conn->get($query);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return ServerProfileResource::collection($data['data']);
    }

    public function show(Request $request, string $id)
    {
        $this->setRouter($request->router, ServerProfileServices::class);
        $data = $this->conn->show($id);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return new ServerProfileResource($data['data']);
    }

    public function update(Request $request, string $id)
    {
        $this->setRouter($request->router, ServerProfileServices::class);
        $this->validate($request, [
            'name'              => 'required|min:2|max:25',
            'hotspot-address'   => 'nullable|ip',
            'dns-name'          => ['nullable', "regex:/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/i"],
        ]);
        $param = [
            '.id'               => $id,
            'name'              => $request->input('name'),
            'hotspot-address'   => $request->input('hotspot-address') ?? '0.0.0.0',
            'dns-name'          => $request->input('dns-name'),
        ];
        $data = $this->conn->update($param);
        return response()->json($data, $data['status'] ? 200 : 422);
    }
}
