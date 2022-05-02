<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class CheckRole
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
        if($request->user()->hasAnyRole(['super-admin','admin'])){
            return $next($request);
        }

        /*if($request->user()->hasRole(Role::USER))
        {
            return redirect('/profile');
        }*/
        return $next($request);
    }
}
