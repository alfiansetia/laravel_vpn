<?php

namespace App\Http\Controllers\Mikapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DHCPController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRouterExists');
    }

    public function lease()
    {
        return view('mikapi.dhcp.lease.index');
    }
}
