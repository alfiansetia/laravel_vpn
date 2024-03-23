<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\UserResource;
use App\Services\Mikapi\Hotspot\UserServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, UserServices::class);
            $query = [];
            if ($request->filled('name')) {
                $query['?name'] = $request->name;
            }
            if ($request->filled('server')) {
                $query['?server'] = $request->input('server');
            }
            if ($request->filled('profile')) {
                $query['?profile'] = $request->input('profile');
            }
            if ($request->filled('comment')) {
                $query['?comment'] = $request->input('comment');
            }
            $data = $this->conn->get($query);
            return UserResource::collection($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, UserServices::class);
            $data = $this->conn->show($id);
            return new UserResource($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'server'        => 'required',
            'name'          => 'required|min:2|max:30',
            'password'      => 'nullable|max:30',
            'profile'       => 'required',
            'address'       => 'nullable|ip',
            'mac-address'   => 'nullable|mac_address',
            // 'time_limit'    => 'number',
            // 'data_limit'    => 'number',
            'comment'       => 'nullable|max:100',
        ]);
        $param = [
            'server'             => $request->input('server') ?? 'all',
            'name'               => $request->input('name'),
            'password'           => $request->input('password'),
            'address'            => $request->input('address') ?? '0.0.0.0',
            'mac-address'        => $request->input('mac-address') ?? '00:00:00:00:00:00',
            'profile'            => $request->input('profile'),
            // 'limit-uptime'       => $request->data_day == null ? $request->time_limit : ($request->data_day . 'd ' . $request->time_limit),
            // 'limit-bytes-total'  => $request->data_limit == null ? '0' : ($request->data_limit . $request->data_type),
            'comment'            => $request->input('comment'),
            'disabled'           => $request->input('disabled') ? 'yes' : 'no',
        ];
        try {
            $this->setRouter($request->router, UserServices::class);
            $data = $this->conn->store($param);
            return response()->json(['message' => 'Success Insert Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'server'        => 'required',
            'name'          => 'required|min:2|max:30',
            'password'      => 'nullable|max:30',
            'profile'       => 'required',
            'address'       => 'nullable|ip',
            'mac-address'   => 'nullable|mac_address',
            // 'time_limit'    => 'number',
            // 'data_limit'    => 'number',
            'comment'       => 'nullable|max:100',
        ]);
        $param = [
            '.id'                => $id,
            'server'             => $request->input('server') ?? 'all',
            'name'               => $request->input('name'),
            'password'           => $request->input('password'),
            'address'            => $request->input('address') ?? '0.0.0.0',
            'mac-address'        => $request->input('mac-address') ?? '00:00:00:00:00:00',
            'profile'            => $request->input('profile'),
            // 'limit-uptime'       => $request->data_day == null ? $request->time_limit : ($request->data_day . 'd ' . $request->time_limit),
            // 'limit-bytes-total'  => $request->data_limit == null ? '0' : ($request->data_limit . $request->data_type),
            'comment'            => $request->input('comment'),
            'disabled'           => $request->input('disabled') ? 'yes' : 'no',
        ];
        try {
            $this->setRouter($request->router, UserServices::class);
            $data = $this->conn->update($param);
            return response()->json(['message' => 'Success Update Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, UserServices::class);
            $data = $this->conn->destroy($id);
            return response()->json(['message' => 'Success Delete Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
