<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Auth;

class User
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
        /*if(Auth::check()){
            if ( auth()->user()->roles()->count() == 1 && auth()->user()->hasRole(Role::USER) )
            {
                 return redirect()->route('profile');
            }
        }*/
        return $next($request); 
    }
}
