<?php

namespace App\Http\Controllers\Mikapi;

use App\Http\Controllers\Controller;
use App\Services\Mikapi\DashboardServices;
use App\Traits\CompanyTrait;
use App\Traits\RouterTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use CompanyTrait, RouterTrait;

    public function __construct()
    {
        $this->middleware(['checkRouterExists']);
    }

    public function index(Request $request)
    {
        return view('mikapi.dashboard');
    }

    public function getData(Request $request)
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
