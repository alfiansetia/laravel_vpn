<?php

namespace App\Http\Controllers\Mikapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRouterExists');
    }

    public function interface()
    {
        return view('mikapi.monitor.interface');
    }
}
