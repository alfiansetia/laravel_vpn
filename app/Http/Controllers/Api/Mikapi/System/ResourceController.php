<?php

namespace App\Http\Controllers\Api\Mikapi\System;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\System\ResourceResource;
use App\Services\Mikapi\System\ResourceServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, ResourceServices::class);
            $query = [];
            $data = $this->conn->get($query);
            return ResourceResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function settings(Request $request)
    {
        try {
            $this->setRouter($request->router, ResourceServices::class);
            $query = [];
            $data = $this->conn->settings($query);
            return ResourceResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
