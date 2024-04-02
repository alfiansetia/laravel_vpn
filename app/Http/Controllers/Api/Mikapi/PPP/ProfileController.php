<?php

namespace App\Http\Controllers\Api\Mikapi\PPP;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\PPP\ProfileResource;
use App\Services\Mikapi\PPP\ProfileServices;
use App\Traits\DataTableTrait;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use RouterTrait, DataTableTrait;

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
            // return response()->json(['message' => 'asd', 'data' => $data], 500);
            $resource = ProfileResource::collection($data);
            return $this->callback($resource->toArray($request), $request->dt == 'on');
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
            'only_one'          => 'nullable|in:default,yes,no',
            'local_address'     => 'nullable|ip',
            'remote_address'    => 'nullable|ip',
            'data_day'          => 'nullable|integer|between:0,365',
            'time_limit'        => 'required|date_format:H:i:s',
            'rate_limit'        => 'nullable|min:5|max:25',
            'parent'            => 'nullable',
            'comment'           => 'nullable|max:100',
        ]);
        $param = [
            'name'              => $request->input('name'),
            'only-one'          => $request->input('only_one') ?? 'default',
            'local-address'     => $request->input('local_address') ?? '0.0.0.0',
            'remote-address'    => $request->input('remote_address') ?? '0.0.0.0',
            'session-timeout'   => ($request->data_day ?? 0) . 'd ' . $request->time_limit,
            'rate-limit'        => $request->input('rate_limit'),
            'parent-queue'      => $request->input('parent') ?? 'none',
            'comment'           => $request->input('comment'),
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
        $validate = [
            'only_one'          => 'nullable|in:default,yes,no',
            'local_address'     => 'nullable|ip',
            'remote_address'    => 'nullable|ip',
            'data_day'          => 'nullable|integer|between:0,365',
            'time_limit'        => 'required|date_format:H:i:s',
            'rate_limit'        => 'nullable|min:5|max:25',
            'parent'            => 'nullable',
            'comment'           => 'nullable|max:100',
        ];
        if ($request->default == 'no') {
            $validate['name'] = 'required|min:1|max:50';
        }
        $this->validate($request, $validate);
        $param = [
            '.id'               => $id,
            'only-one'          => $request->input('only_one') ?? 'default',
            'local-address'     => $request->input('local_address') ?? '0.0.0.0',
            'remote-address'    => $request->input('remote_address') ?? '0.0.0.0',
            'session-timeout'   => ($request->data_day ?? 0) . 'd ' . $request->time_limit,
            'rate-limit'        => $request->input('rate_limit'),
            'parent-queue'      => $request->input('parent') ?? 'none',
            'comment'           => $request->input('comment'),
        ];
        if ($request->default == 'no') {
            $param['name'] = $request->input('name');
        }
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

    public function destroy_batch(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|array|min:1|max:1000'
        ]);
        $id = $request->id;
        try {
            $this->setRouter($request->router, ProfileServices::class);
            $data = $this->conn->destroy_batch($id);
            return response()->json(['message' => 'Success Delete Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
