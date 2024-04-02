<?php

namespace App\Http\Controllers\Mikapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotspotController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRouterExists');
    }

    public function server()
    {
        return view('mikapi.hotspot.server.index');
    }

    public function profile()
    {
        return view('mikapi.hotspot.profile.index');
    }

    public function user()
    {
        return view('mikapi.hotspot.user.index');
    }

    public function active()
    {
        return view('mikapi.hotspot.active.index');
    }

    public function host()
    {
        return view('mikapi.hotspot.host.index');
    }

    public function binding()
    {
        return view('mikapi.hotspot.binding.index');
    }
}
