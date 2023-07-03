<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (!Auth::check())
            return redirect()->to(url('/'));

        $user_role = Auth::user()->getRole();
        if($user_role == 'Admin')
        {
            return $next($request);
        }else{
            return redirect()->to(url('/'));
        }
    }
}
