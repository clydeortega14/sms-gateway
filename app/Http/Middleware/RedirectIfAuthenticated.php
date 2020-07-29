<?php

namespace App\Http\Middleware;

use App\RoleUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')){
                return redirect('/dashboard');
            }
            elseif(auth()->user()->hasRole('head_office') || auth()->user()->hasRole('branch'))
            {
                if(auth()->user()->information_id == null){

                    return redirect('/head-office-information');
                }else{
                    return redirect('/head-office-dashboard');
                }

            }
        }
        return $next($request);
    }
}
