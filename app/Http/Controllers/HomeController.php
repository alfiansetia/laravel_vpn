<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Vpn;
use App\Traits\CompanyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use CompanyTrait;

    private $title = 'Home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $new_users = User::latest()->limit(5)->get();
        $query_expired = Vpn::query()->where('expired', '<=', date('Y-m-d'));
        if ($user->is_admin()) {
            $data_vpn = Vpn::selectRaw('
                SUM(CASE WHEN is_trial = "no" AND is_active = "yes" THEN 1 ELSE 0 END) as active,
                SUM(CASE WHEN is_trial = "yes" AND is_active = "yes" THEN 1 ELSE 0 END) as trial,
                SUM(CASE WHEN is_active = "no" THEN 1 ELSE 0 END) as nonactive
                ')->first();

            $data_user = User::selectRaw('
                SUM(CASE WHEN email_verified_at IS NOT NULL THEN 1 ELSE 0 END) as active,
                SUM(CASE WHEN email_verified_at IS NULL THEN 1 ELSE 0 END) as nonactive
                ')->first();
        } else {
            $query_expired->where('user_id', $user->id);
            $data_vpn = Vpn::where('user_id', $user->id)
                ->selectRaw('
                    SUM(CASE WHEN is_trial = "no" AND is_active = "yes" THEN 1 ELSE 0 END) as active,
                    SUM(CASE WHEN is_trial = "yes" AND is_active = "yes" THEN 1 ELSE 0 END) as trial,
                    SUM(CASE WHEN is_active = "no" THEN 1 ELSE 0 END) as nonactive
                ')
                ->first();
        }
        $new_expired_vpns = $query_expired->latest('expired')->limit(5)->get();
        if ($user->is_admin()) {
            return view('dashboard.admin', compact('data_vpn', 'new_users', 'new_expired_vpns'));
        } else {
            return view('dashboard.user', compact('data_vpn', 'new_users', 'new_expired_vpns'));
        }
    }
}
