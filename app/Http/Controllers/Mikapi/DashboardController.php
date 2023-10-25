<?php

namespace App\Http\Controllers\Mikapi;

use App\Http\Controllers\Controller;
use App\Traits\CompanyTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use CompanyTrait;

    public function __construct()
    {
        $this->middleware(['checkRouterExists']);
    }

    public function index(Request $request)
    {
        $comp = $this->getCompany();
        return view('mikapi.dashboard', compact('comp'))->with('title', 'Dashboard MikApi');
    }
}
