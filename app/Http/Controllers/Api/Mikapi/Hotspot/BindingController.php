<?php

namespace App\Http\Controllers\Api\Mikapi\Hotspot;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mikapi\Hotspot\BindingResource;
use App\Services\Mikapi\Hotspot\BindingServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class BindingController extends Controller
{
    use RouterTrait;

    public function __construct(Request $request)
    {
        $this->middleware('checkRouterExists');
    }

    public function index(Request $request)
    {
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
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return BindingResource::collection($data['data']);
    }

    public function show(Request $request, string $id)
    {
        $this->setRouter($request->router, BindingServices::class);
        $data = $this->conn->show($id);
        if (!$data['status']) {
            return response()->json($data, 422);
        }
        return new BindingResource($data['data']);
    }

    public function store(Request $request)
    {
        $this->setRouter($request->router, BindingServices::class);
        $disabled = filter_var($request->input('disabled'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $this->validate($request, [
            'server'        => 'required',
            'type'          => 'required|in:regular,bypassed,blocked',
            'address'       => 'required_without:mac-address|nullable|ip',
            'to-address'    => 'nullable|ip',
            'mac-address'   => 'required_without:address|nullable|mac_address',
            'comment'       => 'nullable|max:100',
            'disabled'      => 'required|boolean',
        ]);
        $param = [
            'server'        => $request->input('server') ?? 'all',
            'type'          => $request->input('type'),
            'address'       => $request->input('address') ?? '0.0.0.0',
            'to-address'    => $request->input('to-address') ?? '0.0.0.0',
            'mac-address'   => $request->input('mac-address') ?? '00:00:00:00:00:00',
            'comment'       => $request->input('comment'),
            'disabled'      => $request->input('disabled') ? 'yes' : 'no',
        ];
        $data = $this->conn->store($param);
        return response()->json($data, $data['status'] ? 200 : 422);
    }

    public function update(Request $request, string $id)
    {
        $this->setRouter($request->router, BindingServices::class);
        $disabled = filter_var($request->input('disabled'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $this->validate($request, [
            'server'        => 'required',
            'type'          => 'required|in:regular,bypassed,blocked',
            'address'       => 'required_without:mac-address|nullable|ip',
            'to-address'    => 'nullable|ip',
            'mac-address'   => 'required_without:address|nullable|mac_address',
            'comment'       => 'nullable|max:100',
            'disabled'      => 'required|boolean',
        ]);
        $param = [
            '.id'           => $id,
            'server'        => $request->input('server') ?? 'all',
            'type'          => $request->input('type'),
            'address'       => $request->input('address') ?? '0.0.0.0',
            'to-address'    => $request->input('to-address') ?? '0.0.0.0',
            'mac-address'   => $request->input('mac-address') ?? '00:00:00:00:00:00',
            'comment'       => $request->input('comment'),
            'disabled'      => $request->input('disabled') ? 'yes' : 'no',
        ];
        $data = $this->conn->update($param);
        return response()->json($data, $data['status'] ? 200 : 422);
    }

    public function destroy(Request $request, string $id)
    {
        $this->setRouter($request->router, BindingServices::class);
        $data = $this->conn->destroy($id);
        return response()->json($data, $data['status'] ? 200 : 422);
    }
}
