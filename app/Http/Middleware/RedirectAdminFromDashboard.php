<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectAdminFromDashboard
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna adalah admin
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin');
        }

        return $next($request);
    }
}
