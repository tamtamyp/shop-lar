<?php

namespace App\Http\Middleware;

use Closure;

class Login
{
    public function handle($request, Closure $next)
    {
        // Perform action
        
        if(session()->has('username')) return redirect()->route('home');
        return $next($request);
    }
}