<?php

namespace App\Http\Controllers\Mikapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRouterExists');
    }

    public function routerboard()
    {
        return view('mikapi.system.routerboard.index');
    }

    public function resource()
    {
        return view('mikapi.system.resource.index');
    }
}
