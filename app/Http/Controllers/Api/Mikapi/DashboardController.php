<?php

namespace App\Http\Controllers\Api\Mikapi;

use App\Http\Controllers\Controller;
use App\Services\Mikapi\DashboardServices;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use RouterTrait;
    public function get(Request $request)
    {
        try {
            $this->setRouter($request->router, DashboardServices::class);
            $data = $this->conn->get();
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
