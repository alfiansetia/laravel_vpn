<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\ActiveResource;
use App\Services\Mikapi\Hotspot\ActiveServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        $this->setRouter($request->router, ActiveServices::class);
        $query = [];
        if ($request->filled('server')) {
            $query['?server'] = $request->input('server');
        }
        if ($request->filled('address')) {
            $query['?address'] = $request->input('address');
        }
        if ($request->filled('mac-address')) {
            $query['?mac-address'] = $request->input('mac-address');
        }
        if ($request->filled('user')) {
            $query['?user'] = $request->input('user');
        }
        if ($request->filled('profile')) {
            $query['?profile'] = $request->input('profile');
        }
        if ($request->filled('comment')) {
            $query['?comment'] = $request->input('comment');
        }
        $data = $this->conn->get($query);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return ActiveResource::collection($data['data']);
    }

    public function show(Request $request, string $id)
    {
        $this->setRouter($request->router, ActiveServices::class);
        $data = $this->conn->show($id);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return new ActiveResource($data['data']);
    }

    public function destroy(Request $request, string $id)
    {
        $this->setRouter($request->router, ActiveServices::class);
        $data = $this->conn->destroy($id);
        return response()->json($data, $data['status'] ? 200 : 422);
    }
}
