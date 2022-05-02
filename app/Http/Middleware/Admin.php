<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Log;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

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
        if ( Auth::check() ) {
            //$routeName = $request->requestUri;
            // $routeName = Route::currentRouteName();

            // Log::info("Route : $routeName  -- ".Route::currentRouteName());
            if ( Auth::user()->hasAnyRole(Role::SUPER_ADMIN,Role::ADMIN,
                Role::DIRECTOR) ) {
                    return $next($request);
            } 
        } 

        return redirect(route('home'));
    }
}
