<?php

namespace App\Http\Controllers\Api\Mikapi;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\InterfaceResource;
use App\Services\Mikapi\InterfaceServices;
use App\Traits\DataTableTrait;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class InterfaceController extends Controller
{
    use RouterTrait, DataTableTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, InterfaceServices::class);
            $query = [];
            if ($request->filled('name')) {
                $query['?name'] = $request->name;
            }
            if ($request->filled('default-name')) {
                $query['?default-name'] = $request->input('default-name');
            }
            $data = $this->conn->get($query);
            $resource = InterfaceResource::collection($data);
            return $this->callback($resource->toArray($request), $request->dt == 'on');
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, InterfaceServices::class);
            $data = $this->conn->show($id);
            return new InterfaceResource($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $this->setRouter($request->router, InterfaceServices::class);
        $this->validate($request, [
            'name'      => 'required|min:2|max:25',
            'comment'   => 'nullable',
        ]);
        $param = [
            '.id'       => $id,
            'name'      => $request->input('name'),
            'comment'   => $request->input('comment'),
        ];
        $data = $this->conn->update($param);
        return response()->json($data, $data['status'] ? 200 : 422);
    }

    public function monitor(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, InterfaceServices::class);
            $data = $this->conn->monitor($id);
            return response()->json(['data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
