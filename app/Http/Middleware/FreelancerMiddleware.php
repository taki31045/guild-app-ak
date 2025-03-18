<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role_id ==  3 || Auth::user()->role_id ==  1)) {
            return $next($request);
        }
        return redirect('/')->with('error', 'Access denied');
    }
}

