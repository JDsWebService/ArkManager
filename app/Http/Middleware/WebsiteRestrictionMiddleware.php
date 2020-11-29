<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class WebsiteRestrictionMiddleware
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
        Session::flash('warning', "You are trying to view a restricted portion of our site. We have not yet launched, so make sure you sign up for the BETA version which luanches on December 31st, 2020!");
        return redirect()->route('index');
    }
}
