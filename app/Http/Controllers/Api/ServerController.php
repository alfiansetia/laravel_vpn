<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServerResource;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function show(string $id)
    {
        $server = Server::find($id);
        if (!$server) {
            return response()->json(['message' => 'Data Not Found!'], 404);
        }
        return new ServerResource($server);
    }
}
