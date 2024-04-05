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

    public function user()
    {
        return view('mikapi.system.user.index');
    }

    public function group()
    {
        return view('mikapi.system.group.index');
    }
}
