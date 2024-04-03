<?php

namespace App\Http\Controllers\Api\Mikapi\PPP;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\PPP\L2tpSecretResource;
use App\Services\Mikapi\PPP\L2tpSecretServices;
use App\Traits\DataTableTrait;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class L2tpSecretController extends Controller
{
    use RouterTrait, DataTableTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, L2tpSecretServices::class);
            $query = [];
            if ($request->filled('address')) {
                $query['?address'] = $request->address;
            }
            if ($request->filled('comment')) {
                $query['?comment'] = $request->comment;
            }
            $data = $this->conn->get($query);
            $resource = L2tpSecretResource::collection($data);
            return $this->callback($resource->toArray($request), $request->dt == 'on');
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, L2tpSecretServices::class);
            $data = $this->conn->show($id);
            return new L2tpSecretResource($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'secret'            => 'nullable|max:100',
            'address'           => 'nullable|ip',
            'subnet'            => 'nullable|integer|in:0,23,24,25,26,27,28,29,30,31,32',
            'comment'           => 'nullable|max:100',
        ]);
        $address = $request->input('address') ?? '0.0.0.0';
        $subnet = $request->input('subnet');
        $slash = $request->input('subnet') == null ? '' : '/';
        $param = [
            'secret'            => $request->input('secret'),
            'address'           => $address . $slash . $subnet,
            'comment'           => $request->input('comment'),
        ];
        try {
            $this->setRouter($request->router, L2tpSecretServices::class);
            $data = $this->conn->store($param);
            return response()->json(['message' => 'Success Insert Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'secret'            => 'nullable|max:100',
            'address'           => 'nullable|ip',
            'subnet'            => 'nullable|integer|in:0,23,24,25,26,27,28,29,30,31,32',
            'comment'           => 'nullable|max:100',
        ]);
        $address = $request->input('address') ?? '0.0.0.0';
        $subnet = $request->input('subnet');
        $slash = $request->input('subnet') == null ? '' : '/';
        $param = [
            '.id'               => $id,
            'secret'            => $request->input('secret'),
            'address'           => $address . $slash . $subnet,
            'comment'           => $request->input('comment'),
        ];
        try {
            $this->setRouter($request->router, L2tpSecretServices::class);
            $data = $this->conn->update($param);
            return response()->json(['message' => 'Success Update Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, L2tpSecretServices::class);
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
            $this->setRouter($request->router, L2tpSecretServices::class);
            $data = $this->conn->destroy_batch($id);
            return response()->json(['message' => 'Success Delete Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
