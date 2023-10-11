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

    public function index(Request $request)
    {
        $this->setRouter($request->router, UserServices::class);
        $data = $this->conn->get();
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return UserResource::collection($data['data']);
    }
}
