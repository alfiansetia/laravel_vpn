<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\ServerResource;
use App\Services\Mikapi\Hotspot\ServerServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        $this->setRouter($request->router, ServerServices::class);
        $query = [];
        if ($request->filled('name')) {
            $query['?name'] = $request->name;
        }
        $data = $this->conn->get($query);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return ServerResource::collection($data['data']);
    }

    public function show(Request $request, string $id)
    {
        $this->setRouter($request->router, ServerServices::class);
        $data = $this->conn->show($id);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return new ServerResource($data['data']);
    }

    public function update(Request $request, string $id)
    {
        $this->setRouter($request->router, ServerServices::class);
        $disabled = filter_var($request->input('disabled'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $this->validate($request, [
            'name'              => 'required|min:2|max:25',
            'addresses-per-mac' => 'required|integer',
            'disabled'          => 'required|boolean',
        ]);
        $param = [
            '.id'               => $id,
            'name'              => $request->input('name'),
            'addresses-per-mac' => $request->input('addresses-per-mac'),
            'disabled'          => $request->input('disabled') ? 'yes' : 'no',
        ];
        $data = $this->conn->update($param);
        return response()->json($data, $data['status'] ? 200 : 422);
    }
}
