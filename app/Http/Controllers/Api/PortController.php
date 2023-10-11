<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PortResource;
use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function show(string $id)
    {
        $port = Port::whereRelation('vpn', 'user_id', auth()->id())->find($id);
        if (!$port) {
            return response()->json(['message' => 'Data Not Found!'], 404);
        }
        return new PortResource($port->load('vpn.server'));
    }
}
