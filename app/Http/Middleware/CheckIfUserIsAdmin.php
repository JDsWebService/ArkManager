<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CheckIfUserIsAdmin
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
        $user = Auth::user();

        // Check if user is even logged in
        if($user == null) {
            return redirect()->route('login.discord');
        }

        // Check if user is an admin
        if($user->admin == true) {
            View::share('user', $user);
            return $next($request);
        }

        // Fallback return
        return redirect()->route('user.dashboard');

    }
}
