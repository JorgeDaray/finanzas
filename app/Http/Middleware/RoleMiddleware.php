<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Verifica que el usuario tenga el rol especificado
        if (Auth::check() && Auth::user()->roles->contains('name', $role)) {
            return $next($request);
        }

        return redirect('/home');
    }
}



