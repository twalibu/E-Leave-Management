<?php

namespace App\Http\Middleware;

use Closure;

use Sentinel;
use Redirect;

class AdminMiddleware
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

        elseif(Sentinel::inRole('user'))
            return Redirect::to('/home');

        return $next($request);
    }
}
