<?php

namespace App\Http\Controllers\Api\Mikapi\System;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\System\Routerboard\RouterboardResource;
use App\Http\Resources\Mikapi\System\Routerboard\SettingResource;
use App\Services\Mikapi\System\RouterboardServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class RouterboardController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, RouterboardServices::class);
            $query = [];
            $data = $this->conn->routerboard($query);
            return RouterboardResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function settings(Request $request)
    {
        try {
            $this->setRouter($request->router, RouterboardServices::class);
            $query = [];
            $data = $this->conn->setting($query);
            return SettingResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
