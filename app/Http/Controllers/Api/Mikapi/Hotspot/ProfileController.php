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
        $this->setRouter($request->router, ProfileServices::class);
        $query = [];
        if ($request->filled('name')) {
            $query['?name'] = $request->name;
        }
        $data = $this->conn->get($query);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return ProfileResource::collection($data['data']);
    }

    public function show(Request $request, string $id)
    {
        $this->setRouter($request->router, ProfileServices::class);
        $data = $this->conn->show($id);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return new ProfileResource($data['data']);
    }

    public function store(Request $request)
    {
        $this->setRouter($request->router, ProfileServices::class);
        $this->validate($request, [
            'name'              => 'required|min:2|max:25',
            'shared-users'      => 'integer',
            'rate-limit'        => 'nullable',
            'session-timeout'   => 'nullable',
        ]);
        $param = [
            'name'              => $request->input('name'),
            'shared-users'      => $request->input('shared-users'),
            'rate-limit'        => $request->input('rate-limit'),
            'session-timeout'   => $request->input('session-timeout') ?? '00:00:00',
        ];
        $data = $this->conn->store($param);
        return response()->json($data, $data['status'] ? 200 : 422);
    }

    public function update(Request $request, string $id)
    {
        $this->setRouter($request->router, ProfileServices::class);
        $this->validate($request, [
            'name'              => 'required|min:2|max:25',
            'shared-users'      => 'integer',
            'rate-limit'        => 'nullable',
            'session-timeout'   => 'nullable',
        ]);
        $param = [
            '.id'               => $id,
            'name'              => $request->input('name'),
            'shared-users'      => $request->input('shared-users'),
            'rate-limit'        => $request->input('rate-limit'),
            'session-timeout'   => $request->input('session-timeout') ?? '00:00:00',
        ];
        $data = $this->conn->update($param);
        return response()->json($data, $data['status'] ? 200 : 422);
    }

    public function destroy(Request $request, string $id)
    {
        $this->setRouter($request->router, ProfileServices::class);
        $data = $this->conn->destroy($id);
        return response()->json($data, $data['status'] ? 200 : 422);
    }
}
