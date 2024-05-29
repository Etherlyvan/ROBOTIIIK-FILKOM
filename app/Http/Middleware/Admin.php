<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if there is an authenticated user
        $user = Auth::guard('web')->user();

        if ($user && $user->is_admin) {
            return $next($request);
        }

        abort(401);
    }
}
