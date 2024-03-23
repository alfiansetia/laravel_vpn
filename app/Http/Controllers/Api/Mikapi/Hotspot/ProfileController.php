<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\ProfileResource;
use App\Services\Mikapi\Hotspot\ProfileServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, ProfileServices::class);
            $query = [];
            if ($request->filled('name')) {
                $query['?name'] = $request->name;
            }
            $data = $this->conn->get($query);
            return ProfileResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, ProfileServices::class);
            $data = $this->conn->show($id);
            return new ProfileResource($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required|min:1|max:50',
            'shared_users'      => 'integer|gte:0',
            'rate_limit'        => 'nullable',
            'session_timeout'   => 'nullable',
        ]);
        $param = [
            'name'              => $request->input('name'),
            'shared-users'      => $request->input('shared_users'),
            'rate-limit'        => $request->input('rate_limit'),
            'session-timeout'   => $request->input('session_timeout') ?? '00:00:00',
        ];
        try {
            $this->setRouter($request->router, ProfileServices::class);
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
            'shared_users'      => 'integer|gte:0',
            'rate_limit'        => 'nullable',
            'session_timeout'   => 'nullable',
        ]);
        $param = [
            '.id'               => $id,
            'name'              => $request->input('name'),
            'shared-users'      => $request->input('shared_users'),
            'rate-limit'        => $request->input('rate_limit'),
            'session-timeout'   => $request->input('session_timeout') ?? '00:00:00',
        ];
        try {
            $this->setRouter($request->router, ProfileServices::class);
            $data = $this->conn->update($param);
            return response()->json(['message' => 'Success Update Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, ProfileServices::class);
            $data = $this->conn->destroy($id);
            return response()->json(['message' => 'Success Delete Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
