<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\HostResource;
use App\Services\Mikapi\Hotspot\HostServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class HostController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        $this->setRouter($request->router, HostServices::class);
        $query = [];
        if ($request->filled('server')) {
            $query['?server'] = $request->input('server');
        }
        if ($request->filled('address')) {
            $query['?address'] = $request->input('address');
        }
        if ($request->filled('to-address')) {
            $query['?to-address'] = $request->input('to-address');
        }
        if ($request->filled('mac-address')) {
            $query['?mac-address'] = $request->input('mac-address');
        }
        if ($request->filled('comment')) {
            $query['?comment'] = $request->input('comment');
        }
        $data = $this->conn->get($query);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return HostResource::collection($data['data']);
    }

    public function show(Request $request, string $id)
    {
        $this->setRouter($request->router, HostServices::class);
        $data = $this->conn->show($id);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return new HostResource($data['data']);
    }

    public function destroy(Request $request, string $id)
    {
        $this->setRouter($request->router, HostServices::class);
        $data = $this->conn->destroy($id);
        return response()->json($data, $data['status'] ? 200 : 422);
    }
}
