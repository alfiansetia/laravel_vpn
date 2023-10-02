<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Vpn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $title = 'Home';
    private $comp;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->comp = Company::first();
    }

    public function index()
    {
        //
        $comp = $this->comp;
        $user = Auth::user();
        if (isAdmin()) {
            $data_vpn = [
                'active'    => Vpn::where('masa', '>', 0)->where('is_active', 1)->count(),
                'trial'     => Vpn::where('masa', '=', 0)->where('is_active', 1)->count(),
                'nonactive' => Vpn::where('is_active', '=', 0)->count()
            ];
            // $dataVpn = Vpn::whereIn()
            $data_user = [
                'active'    => User::where('email_verified_at', '!=', null)->count(),
                'nonactive' => User::where('email_verified_at', '=', null)->count()
            ];
            return view('dashboard.admin', compact('user', 'data_vpn', 'comp'))->with('title', 'Dashboard');
        } else {
            $data_vpn = [
                'active'    => Vpn::where('user_id', '=', $user->id)->where('masa', '>', 0)->where('is_active', 1)->count(),
                'trial'     => Vpn::where('user_id', '=', $user->id)->where('masa', '=', 0)->where('is_active', 1)->count(),
                'nonactive' => Vpn::where('user_id', '=', $user->id)->where('is_active', '=', 0)->count()
            ];
            return view('dashboard.user', compact(['user', 'data_vpn', 'comp']))->with('title', 'Dashboard');
        }
    }
}
