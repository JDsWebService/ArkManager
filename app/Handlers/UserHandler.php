<?php


namespace App\Handlers;


use Illuminate\Support\Facades\Auth;

class UserHandler
{
    /**
     * Returns the logged in user
     *
     * @return \App\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function getLoggedInUser() {
        return Auth::user();
    }

    /**
     * Returns the logged in user's id
     *
     * @return mixed
     */
    public static function getUserID() {
        return self::getLoggedInUser()->id;
    }

}
