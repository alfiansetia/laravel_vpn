<?php

namespace App\Http\Controllers\Api\Mikapi\PPP;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\PPP\SecretResource;
use App\Services\Mikapi\PPP\SecretServices;
use App\Traits\DataTableTrait;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class SecretController extends Controller
{
    use RouterTrait, DataTableTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, SecretServices::class);
            $query = [];
            if ($request->filled('name')) {
                $query['?name'] = $request->name;
            }
            $data = $this->conn->get($query);
            $resource = SecretResource::collection($data);
            return $this->callback($resource->toArray($request), $request->dt == 'on');
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, SecretServices::class);
            $data = $this->conn->show($id);
            return new SecretResource($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required|min:1|max:50',
            'password'          => 'nullable|max:50',
            'service'           => 'nullable|in:any,async,l2tp,ovpn,pppoe,pptp,sstp',
            'profile'           => 'required',
            'local_address'     => 'nullable|ip',
            'remote_address'    => 'nullable|ip',
            'comment'           => 'nullable|max:100',
        ]);
        $param = [
            'name'              => $request->input('name'),
            'password'          => $request->input('password'),
            'service'           => $request->input('service') ?? 'any',
            'profile'           => $request->input('profile'),
            'local-address'     => $request->input('local_address') ?? '0.0.0.0',
            'remote-address'    => $request->input('remote_address') ?? '0.0.0.0',
            'comment'           => $request->input('comment'),
        ];
        try {
            $this->setRouter($request->router, SecretServices::class);
            $data = $this->conn->store($param);
            return response()->json(['message' => 'Success Insert Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'              => 'required|min:1|max:50',
            'password'          => 'nullable|max:50',
            'service'           => 'required|in:any,async,l2tp,ovpn,pppoe,pptp,sstp',
            'profile'           => 'required',
            'local_address'     => 'nullable|ip',
            'remote_address'    => 'nullable|ip',
            'comment'           => 'nullable|max:100',
            'is_active'         => 'nullable|in:on',
        ]);
        $param = [
            '.id'               => $id,
            'name'              => $request->input('name'),
            'password'          => $request->input('password'),
            'service'           => $request->input('service') ?? 'any',
            'profile'           => $request->input('profile'),
            'local-address'     => $request->input('local_address') ?? '0.0.0.0',
            'remote-address'    => $request->input('remote_address') ?? '0.0.0.0',
            'comment'           => $request->input('comment'),
            'disabled'          => $request->input('is_active') == 'on' ? 'no' : 'yes',
        ];
        try {
            $this->setRouter($request->router, SecretServices::class);
            $data = $this->conn->update($param);
            return response()->json(['message' => 'Success Update Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, SecretServices::class);
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
            $this->setRouter($request->router, SecretServices::class);
            $data = $this->conn->destroy_batch($id);
            return response()->json(['message' => 'Success Delete Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
