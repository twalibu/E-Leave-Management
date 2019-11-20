<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Redirect;

class UserMiddleware
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

        if(!Sentinel::check())
            return Redirect::to('/')->with('info', 'You must be logged in!');


        return $next($request);

    }
}
