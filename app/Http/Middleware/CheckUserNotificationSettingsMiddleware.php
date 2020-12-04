<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckUserNotificationSettingsMiddleware
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

        if($user->discord_notifications == false || $user->internal_notifications == false) {
            Session::flash('warning', 'You have turned off the ability for anyone to contact you. You can not use this feature. Go to your account settings page and turn on Discord & Internal Notifications to continue.');
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
