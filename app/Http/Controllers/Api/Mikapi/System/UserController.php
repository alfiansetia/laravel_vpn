<?php

namespace App\Http\Controllers\Api\Mikapi\System;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\System\UserResource;
use App\Services\Mikapi\System\UserServices;
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
        $data = $this->conn->get($query);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return UserResource::collection($data['data']);
    }
}
