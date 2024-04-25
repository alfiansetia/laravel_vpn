<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            if ($user != null) {
                $user->update(['status' => 'active']);
                $user->markEmailAsVerified();
                \auth()->login($user, true);
                return redirect()->route('home');
            } else {
                $create = User::Create([
                    'email'     => $user_google->getEmail(),
                    'name'      => $user_google->getName(),
                    'password'  => 0,
                    'role'      => 'user',
                    'status'    => 'active',
                ]);
                $create->markEmailAsVerified();
                \auth()->login($create, true);
                // return response()->json($create);
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }

    public function redirectToProviderFb()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFb(Request $request)
    {
        try {
            $user_fb    = Socialite::driver('facebook')->user();
            $user           = User::where('email', $user_fb->getEmail())->first();
            if ($user != null) {
                $user->update(['status' => 'active']);
                $user->markEmailAsVerified();
                \auth()->login($user, true);
                return redirect()->route('home');
            } else {
                $create = User::Create([
                    'email'     => $user_fb->getEmail(),
                    'name'      => $user_fb->getName(),
                    'password'  => 0,
                    'role'      => 'user',
                    'status'    => 'active',

                ]);
                $create->markEmailAsVerified();
                \auth()->login($create, true);
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }

    public function onetap(Request $request)
    {
        $token = $request->credential;
        $tokenParts = explode('.', $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);
        $user = $jwtPayload;
        // return $user;
        $user = User::where('email', $user->email)->first();

        if ($user != null) {
            $user->update(['status' => 'active']);
            $user->markEmailAsVerified();
            \auth()->login($user, true);
            return redirect()->route('home');
        } else {
            $create = User::Create([
                'email'     => $user->email,
                'name'      => $user->name,
                'password'  => 0,
                'role'      => 'user',
                'status'    => 'active',
            ]);
            $create->markEmailAsVerified();
            \auth()->login($create, true);
            return redirect()->route('home');
        }
    }
}
