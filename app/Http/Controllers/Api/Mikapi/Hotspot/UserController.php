<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\UserResource;
use App\Services\Mikapi\Hotspot\UserServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        $this->setRouter($request->router, UserServices::class);
        $query = [];
        if ($request->filled('name')) {
            $query['?name'] = $request->name;
        }
        if ($request->filled('profile')) {
            $query['?profile'] = $request->profile;
        }
        if ($request->filled('comment')) {
            $query['?comment'] = $request->comment;
        }
        $data = $this->conn->get($query);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return UserResource::collection($data['data']);
    }

    public function show(Request $request, string $id)
    {
        $this->setRouter($request->router, UserServices::class);
        $data = $this->conn->show($id);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return new UserResource($data['data']);
    }

    public function store(Request $request)
    {
        $this->setRouter($request->router, UserServices::class);
    }

    public function update(Request $request, string $id)
    {
        $this->setRouter($request->router, UserServices::class);
    }

    public function destroy(Request $request, string $id)
    {
        $this->setRouter($request->router, UserServices::class);
        $data = $this->conn->destroy($id);
        return response()->json($data, $data['status'] ? 200 : 422);
    }
}
