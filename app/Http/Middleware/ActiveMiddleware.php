<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->status != 'active') {
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['message' => 'Your account is Nonactive!'], 403);
            }
            return redirect()->route('home')->with('error', 'Your account is Nonactive!');
        }
        return $next($request);
    }
}
