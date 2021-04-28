<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Flash;

class ActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * 
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->is_active) {
            return $next($request);
        } else {
            Auth::logout();
            Flash::error(Lang::get("flash.inactive_user"));
            return redirect(route("login"));
        }
    }
}
