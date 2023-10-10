<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VpnResource;
use App\Models\Vpn;
use Illuminate\Http\Request;

class VpnController extends Controller
{
    public function index(Request $request)
    {
        $limit = 10;
        if ($request->filled('limit') && is_numeric($request->limit) && $request->limit > 0) {
            $limit = $request->limit;
        }
        $data = Vpn::with('server')->where('user_id', auth()->id())->paginate($limit)->withQueryString();
        return VpnResource::collection($data);
    }

    public function show(string $id)
    {
        $vpn = Vpn::where('user_id', 'id', auth()->id())->find($id);
        if (!$vpn) {
            return response()->json(['message' => 'Data Not Found!'], 404);
        }
        return new VpnResource($vpn->load('server', 'port'));
    }
}
