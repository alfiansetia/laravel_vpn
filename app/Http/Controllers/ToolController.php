<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function __construct()
    {
        $this->middleware('is.admin');
    }

    public function php_info()
    {
        phpinfo();
    }
}
