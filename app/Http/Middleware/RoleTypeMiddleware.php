<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (in_array(Auth::user()->role, $role)) {
            return $next($request);
        }

        if (! $request->expectsJson()) {
            return route('login');
        } else {
            abort(403);
        }
    }
}
