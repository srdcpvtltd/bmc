<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CollectionStaff
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
         dd($user_role);
        if($user_role == 'Collection Staff')
        {
            return $next($request);
        }else{
            return redirect()->to(url('/'));
        }
    }
}
