<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->is_superuser || auth()->user()->is_staff)) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'You do not have permission to access this page.');
    }
}
