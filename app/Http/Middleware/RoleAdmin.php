<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!isAdmin()) {
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['message' => 'Unauthorize!'], 403);
            }
            return redirect(route('home'))->withErrors(['errors' => 'Unauthorize!'])->withInput();
        }
        return $next($request);
    }
}
