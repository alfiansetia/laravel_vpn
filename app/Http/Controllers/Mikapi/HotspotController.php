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
}
