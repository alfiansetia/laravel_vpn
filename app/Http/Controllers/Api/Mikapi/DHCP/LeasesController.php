<?php

namespace App\Http\Controllers\Api\Mikapi\DHCP;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\DHCP\LeasesResource;
use App\Services\Mikapi\DHCP\LeaseServices;
use App\Traits\DataTableTrait;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class LeasesController extends Controller
{
    use RouterTrait, DataTableTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, LeaseServices::class);
            $query = [];
            if ($request->filled('server')) {
                $query['?server'] = $request->input('server');
            }
            if ($request->filled('address')) {
                $query['?address'] = $request->input('address');
            }
            if ($request->filled('mac-address')) {
                $query['?mac-address'] = $request->input('mac-address');
            }
            if ($request->filled('user')) {
                $query['?user'] = $request->input('user');
            }
            if ($request->filled('comment')) {
                $query['?comment'] = $request->input('comment');
            }
            $data = $this->conn->get($query);
            $resource = LeasesResource::collection($data);
            return $this->callback($resource->toArray($request), $request->dt == 'on');
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, LeaseServices::class);
            $data = $this->conn->show($id);
            return new LeasesResource($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, LeaseServices::class);
            $data = $this->conn->destroy($id);
            return response()->json(['message' => 'Success Delete Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy_batch(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|array|min:1|max:1000'
        ]);
        $id = $request->id;
        try {
            $this->setRouter($request->router, LeaseServices::class);
            $data = $this->conn->destroy_batch($id);
            return response()->json(['message' => 'Success Delete Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
