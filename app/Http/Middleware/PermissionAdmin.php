<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\UserModel;

class PermissionAdmin
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
            $username = $request->session()->get('username');
            $db = UserModel::where('username', $username)->first();
            // dd($db['level']);
            if ($db['level'] == 'admin') {
                return $next($request);
            } else {
                return redirect()->route('noPermission');
            }
        }
        return redirect()->route('login');
    }
}
