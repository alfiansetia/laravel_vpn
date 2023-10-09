<?php

namespace App\Http\Middleware;

use App\Models\Router;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CheckRouterExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make(
            $request->all(),
            [
                'router' => [
                    'required',
                    'integer',
                    'exists:routers,id,user_id,' . auth()->user()->id,
                    function ($attribute, $value, $fail) use ($request) {
                        $router = Router::where('user_id', auth()->user()->id)->with('port.vpn.server')->find($request->input('router'));
                        if ($router) {
                            if (!$router->port) {
                                return $fail('Select VPN on Router');
                            }
                            if ($router->port->vpn->is_active == 'no') {
                                return $fail('Your VPN Nonactive!');
                            }
                            if ($router->port->vpn->server->is_active == 'no') {
                                return $fail('Server OFF! Contact Admin.');
                            }
                        }
                    },
                ]
            ],
            [
                'router.required'   => 'Router belum dipilih',
                'router.exists'     => 'Router yang dipilih tidak ada!',
            ],
        );
        if ($validator->fails()) {
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect(route('router.index'))->withErrors($validator)->withInput();
        }
        return $next($request);
    }
}
