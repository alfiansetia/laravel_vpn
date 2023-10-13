<?php

namespace App\Http\Controllers\Api\Mikapi\System;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\System\PackageResource;
use App\Services\Mikapi\System\PackageServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        $this->setRouter($request->router, PackageServices::class);
        $query = [];
        if ($request->filled('name')) {
            $query['?name'] = $request->name;
        }
        if ($request->filled('bundle')) {
            $query['?bundle'] = $request->input('bundle');
        }
        $data = $this->conn->get($query);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return PackageResource::collection($data['data']);
    }
}
