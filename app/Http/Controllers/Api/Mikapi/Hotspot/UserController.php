<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\UserResource;
use App\Services\Mikapi\Hotspot\UserServices;
use App\Traits\DataTableTrait;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    use RouterTrait, DataTableTrait;

    private $path;
    private $full_path;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
        $this->path = storage_path('app/mikapi/hotspot/user');
        $this->full_path = $this->path . '/' . $request->router . '.json';
    }

    public function index(Request $request)
    {
        try {
            $dt = $request->dt == 'on';
            if ($request->refresh == 'on' || !file_exists($this->full_path)) {
                $this->setRouter($request->router, UserServices::class);
                $query = [];
                if ($request->filled('name')) {
                    $query['?name'] = $request->name;
                }
                if ($request->filled('server')) {
                    $query['?server'] = $request->input('server');
                }
                if ($request->filled('address')) {
                    $query['?address'] = $request->input('address');
                }
                if ($request->filled('mac-address')) {
                    $query['?mac-address'] = $request->input('mac-address');
                }
                if ($request->filled('profile')) {
                    $query['?profile'] = $request->input('profile');
                }
                if ($request->filled('comment')) {
                    $query['?comment'] = $request->input('comment');
                }
                $data = $this->conn->get($query);
                if (!File::exists($this->path)) {
                    File::makeDirectory($this->path, 755, true);
                }
                $json = UserResource::collection($data);
                File::put($this->full_path, $json->toJson(JSON_PRETTY_PRINT));
                return $this->callback($json->toArray($request), $dt);
            }
            $file = file_get_contents($this->full_path);
            $d = json_decode($file, true);
            return $this->callback($d, $dt);
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
            'server'        => 'nullable',
            'profile'       => 'required',
            'name'          => 'required|min:2|max:50',
            'password'      => 'nullable|max:50',
            'ip_address'    => 'nullable|ip',
            'mac'           => 'nullable|mac_address',
            'data_day'      => 'nullable|integer|between:0,365',
            'time_limit'    => 'required|date_format:H:i:s',
            'data_limit'    => 'required|integer|gte:0',
            'data_type'     => 'nullable|in:K,M,G',
            'comment'       => 'nullable|max:100',
            'is_active'     => 'nullable|in:on',
        ]);
        $param = [
            'server'             => $request->input('server') ?? 'all',
            'profile'            => $request->input('profile'),
            'name'               => $request->input('name'),
            'password'           => $request->input('password'),
            'address'            => $request->input('ip_address') ?? '0.0.0.0',
            'mac-address'        => $request->input('mac') ?? '00:00:00:00:00:00',
            'limit-uptime'       => ($request->data_day ?? 0) . 'd ' . $request->time_limit,
            'limit-bytes-total'  => $request->data_limit . ($request->data_type ?? 'K'),
            'comment'            => $request->input('comment'),
            'disabled'           => $request->input('is_active') == 'on' ? 'no' : 'yes',
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
            'server'        => 'nullable',
            'profile'       => 'required',
            'name'          => 'required|min:2|max:50',
            'password'      => 'nullable|max:50',
            'ip_address'    => 'nullable|ip',
            'mac'           => 'nullable|mac_address',
            'data_day'      => 'required|integer|between:0,365',
            'time_limit'    => 'required|date_format:H:i:s',
            'data_limit'    => 'required|integer|gte:0',
            'data_type'     => 'required|in:K,M,G',
            'comment'       => 'nullable|max:100',
            'is_active'     => 'nullable|in:on',
        ]);
        $param = [
            '.id'                => $id,
            'server'             => $request->input('server') ?? 'all',
            'profile'            => $request->input('profile'),
            'name'               => $request->input('name'),
            'password'           => $request->input('password'),
            'address'            => $request->input('ip_address') ?? '0.0.0.0',
            'mac-address'        => $request->input('mac') ?? '00:00:00:00:00:00',
            'limit-uptime'       => ($request->data_day ?? 0) . 'd ' . $request->time_limit,
            'limit-bytes-total'  => $request->data_limit . $request->data_type,
            'comment'            => $request->input('comment'),
            'disabled'           => $request->input('is_active') == 'on' ? 'no' : 'yes',
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

    public function destroy_batch(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|array|min:1|max:1000'
        ]);
        $id = $request->id;
        try {
            $this->setRouter($request->router, UserServices::class);
            $data = $this->conn->destroy_batch($id);
            return response()->json(['message' => 'Success Delete Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
