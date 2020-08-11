<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard(GUARD_DASHBOARD)->check()) {
            if (Auth::guard(GUARD_DASHBOARD)->user()->is_super === false) {
                return redirect()->route('dashboard.partner.vendors');
            }
        } else {
            return redirect()->route('dashboard.login');
        }

        return $next($request);
    }
}
