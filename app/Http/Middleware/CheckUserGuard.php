<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserGuard
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika sudah login sebagai admin
        if (Auth::guard('admin')->check()) {
            view()->share('userGuard', 'admin');
            view()->share('userData', Auth::guard('admin')->user());
        }
        // Jika sudah login sebagai mahasiswa
        elseif (Auth::guard('web')->check()) {
            view()->share('userGuard', 'mahasiswa');
            view()->share('userData', Auth::guard('web')->user());
        } else {
            view()->share('userGuard', 'guest');
            view()->share('userData', null);
        }

        return $next($request);
    }
}