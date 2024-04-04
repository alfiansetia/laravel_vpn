<?php

namespace App\Http\Controllers\Api\Mikapi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\LogResource;
use App\Services\Mikapi\LogServices;
use App\Traits\DataTableTrait;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class LogController extends Controller
{
    use RouterTrait, DataTableTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, LogServices::class);
            $query = [];
            if ($request->filled('topics')) {
                $query['?topics'] = $request->input('topics');
            }
            $data = $this->conn->get($query);
            $resource = LogResource::collection($data);
            return $this->callback($resource->toArray($request), $request->dt == 'on');
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }


    public function show(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, LogServices::class);
            $data = $this->conn->show($id);
            return new LogResource($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $this->setRouter($request->router, LogServices::class);
            $data = $this->conn->destroy();
            return response()->json(['message' => 'Success deleted data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
