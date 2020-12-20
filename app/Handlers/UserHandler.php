<?php


namespace App\Handlers;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\BadResponseException;

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

    /**
     * Returns the user avatar or the placeholder avatar
     * depending on the Discord Status Code
     *
     * @param \App\Models\Auth\User $user
     * @return \Illuminate\Http\RedirectResponse|mixed|string
     */
    public static function getUserAvatar(\App\Models\Auth\User $user) {
        $client = new Client();
        try {
            $response = $client->request('GET', $user->avatar, ['allow_redirects' => false, 'verify' => false]);
        } catch(BadResponseException $e) {
            return "https://dummyimage.com/128x128/888ea8/ebedf2.png?text=No+Image+Found";
        }

        if($response->getStatusCode() == 200) {
            return $user->avatar;
        } else {
            return "https://dummyimage.com/128x128/888ea8/ebedf2.png?text=No+Image+Found";
        }
    }

}
