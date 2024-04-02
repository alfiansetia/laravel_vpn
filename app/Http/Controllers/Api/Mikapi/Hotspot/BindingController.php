<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\BindingResource;
use App\Services\Mikapi\Hotspot\BindingServices;
use App\Traits\DataTableTrait;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class BindingController extends Controller
{
    use RouterTrait, DataTableTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
        try {
            $this->setRouter($request->router, BindingServices::class);
            $query = [];
            if ($request->filled('name')) {
                $query['?name'] = $request->name;
            }
            if ($request->filled('profile')) {
                $query['?profile'] = $request->profile;
            }
            if ($request->filled('comment')) {
                $query['?comment'] = $request->comment;
            }
            $data = $this->conn->get($query);
            $resource = BindingResource::collection($data);
            return $this->callback($resource->toArray($request), $request->dt == 'on');
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, BindingServices::class);
            $data = $this->conn->show($id);
            return new BindingResource($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'server'        => 'nullable',
            'type'          => 'nullable|in:regular,bypassed,blocked',
            'address'       => 'required_without:mac|nullable|ip',
            'to_address'    => 'nullable|ip',
            'mac'           => 'required_without:address|nullable|mac_address',
            'comment'       => 'nullable|max:100',
            'is_active'     => 'nullable|in:on',
        ]);
        $param = [
            'server'        => $request->input('server') ?? 'all',
            'type'          => $request->input('type') ?? 'regular',
            'address'       => $request->input('address') ?? '0.0.0.0',
            'to-address'    => $request->input('to_address') ?? '0.0.0.0',
            'mac-address'   => $request->input('mac') ?? '00:00:00:00:00:00',
            'comment'       => $request->input('comment'),
            'disabled'      => $request->input('is_active') == 'on' ? 'no' : 'yes',
        ];
        try {
            $this->setRouter($request->router, BindingServices::class);
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
            'type'          => 'required|in:regular,bypassed,blocked',
            'address'       => 'required_without:mac|nullable|ip',
            'to_address'    => 'nullable|ip',
            'mac'           => 'required_without:address|nullable|mac_address',
            'comment'       => 'nullable|max:100',
            'is_active'     => 'nullable|in:on',
        ]);
        $param = [
            '.id'           => $id,
            'server'        => $request->input('server') ?? 'all',
            'type'          => $request->input('type') ?? 'regular',
            'address'       => $request->input('address') ?? '0.0.0.0',
            'to-address'    => $request->input('to_address') ?? '0.0.0.0',
            'mac-address'   => $request->input('mac') ?? '00:00:00:00:00:00',
            'comment'       => $request->input('comment'),
            'disabled'      => $request->input('is_active') == 'on' ? 'no' : 'yes',
        ];
        try {
            $this->setRouter($request->router, BindingServices::class);
            $data = $this->conn->update($param);
            return response()->json(['message' => 'Success Update Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy(Request $request, string $id)
    {
        try {
            $this->setRouter($request->router, BindingServices::class);
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
            $this->setRouter($request->router, BindingServices::class);
            $data = $this->conn->destroy_batch($id);
            return response()->json(['message' => 'Success Delete Data!', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
