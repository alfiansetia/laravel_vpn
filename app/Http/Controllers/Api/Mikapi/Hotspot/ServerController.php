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
        $data = $this->conn->get();
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return ServerResource::collection($data['data']);
    }
}
