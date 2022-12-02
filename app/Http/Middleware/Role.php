<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, String $role) {
        if (!Auth::check()){
            return redirect('/');
        }
        $userRole = Auth::user()->user_role->role->slug;
        if($userRole == $role){
            return $next($request);
        }
        return redirect()->back()->withErrors('You Are Not Authorized');
    }
}
