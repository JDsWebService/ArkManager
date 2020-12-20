<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckIfUserAcceptsConditions
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
        if(!$user) {
            return redirect()->route('login.discord');
        }
        $privacy = $this->checkPrivacyAccept($user);
        $terms = $this->checkTermsAccept($user);
        if(!$privacy || !$terms) {
            Session::flash('warning', 'You have not accepted the Terms of Service or Privacy Policy, please do so now before continuing.');
            return redirect()->route('accept.conditions');
        }

        return $next($request);
    }

    private function checkPrivacyAccept($user)
    {
        if($user->privacy_accept) {
            return true;
        }
        return false;
    }

    private function checkTermsAccept($user)
    {
        if($user->tos_accept) {
            return true;
        }
        return false;
    }


}
