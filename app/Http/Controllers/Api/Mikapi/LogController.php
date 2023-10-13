<?php

namespace App\Http\Controllers\Api\Mikapi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\LogResource;
use App\Services\Mikapi\LogServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class LogController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        $this->setRouter($request->router, LogServices::class);
        $query = [];
        if ($request->filled('topics')) {
            $query['?topics'] = $request->input('topics');
        }
        $data = $this->conn->get($query);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return LogResource::collection($data['data']);
    }

    public function show(Request $request, string $id)
    {
        $this->setRouter($request->router, LogServices::class);
        $data = $this->conn->show($id);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return new LogResource($data['data']);
    }
}
