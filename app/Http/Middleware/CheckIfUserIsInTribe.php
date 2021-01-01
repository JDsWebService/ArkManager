<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckIfUserIsInTribe
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

        if($user->tribe == null) {
            Session::flash('warning', 'You must create a tribe first before using this tool.');
            return redirect()->route('tribe.management.create');
        }

        // Fallback return
        return $next($request);
    }
}
