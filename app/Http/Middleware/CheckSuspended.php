<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSuspended
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_suspended) {
            Auth::logout();

            return redirect()->route('login')
                ->with('error', 'Votre compte a été suspendu. Contactez l\'administrateur.');
        }

        return $next($request);
    }
}
