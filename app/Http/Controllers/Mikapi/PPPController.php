<?php

namespace App\Http\Controllers\Mikapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PPPController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRouterExists');
    }

    public function profile()
    {
        return view('mikapi.ppp.profile.index');
    }

    public function secret()
    {
        return view('mikapi.ppp.secret.index');
    }

    public function active()
    {
        return view('mikapi.ppp.active.index');
    }

    public function l2tp_secret()
    {
        return view('mikapi.ppp.l2tp_secret.index');
    }
}
