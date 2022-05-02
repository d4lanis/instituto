<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        //Log::info($roles);
        $userRoles = auth()->user()->roles->pluck('name')->toArray();
        $permittedRoles= explode("|",$roles);

        $result= array_intersect($userRoles,$permittedRoles);

        if(auth()->check()){
            if(count($result)>=1){
                return $next($request);
            }

            return abort(403);
        }

        return redirect('/login');
    }
}
