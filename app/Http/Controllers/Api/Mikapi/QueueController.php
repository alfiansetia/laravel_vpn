<?php

namespace App\Http\Controllers\Api\Mikapi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\QueueResource;
use App\Services\Mikapi\QueueServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    use RouterTrait;
    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, QueueServices::class);
            $query = [];
            if ($request->filled('name')) {
                $query['?name'] = $request->name;
            }
            $data = $this->conn->get($query);
            return QueueResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


    public function show(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, QueueServices::class);
            $data = $this->conn->show($id);
            return new QueueResource($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
