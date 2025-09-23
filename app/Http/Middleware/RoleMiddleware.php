<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('account');
        }

        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
