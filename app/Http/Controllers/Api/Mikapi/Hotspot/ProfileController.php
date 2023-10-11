<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\ProfileResource;
use App\Models\Router;
use App\Services\Mikapi\Hotspot\ProfileServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use RouterTrait;

    public function __construct()
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        $this->setRouter($request->router, ProfileServices::class);
        $data = $this->conn->get();
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        // return $data['data'];
        return ProfileResource::collection($data['data']);
    }
}
