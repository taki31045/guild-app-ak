<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role_id ==  2 || Auth::user()->role_id ==  1)) {
            return $next($request);
        }
        return redirect('/')->with('error', 'Access denied');
    }
}

