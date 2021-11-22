<?php

namespace App\Http\Middleware;

use Closure;

// use App\Models\UserModel;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Perform action
        if ($request->session()->has('username')) {
            return $next($request);
        } else {
            return redirect()->route('noLogin');
        }
    }
}
