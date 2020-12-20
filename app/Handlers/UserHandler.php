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
        $url = $user->avatar;
        if( is_null( $url ) ){
            return "https://dummyimage.com/128x128/888ea8/ebedf2.png?text=No+Image+Found";
        }else{
            $handle = curl_init($url);
            curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
            curl_exec($handle);
            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            if( $code == '404' ){
                return "https://dummyimage.com/128x128/888ea8/ebedf2.png?text=No+Image+Found";
            }else{
                return $user->avatar;
            }
            curl_close($handle);
        }

        // -------------------------------------------------------------- //
        // The following Guzzle Check will be left here to later come back to
        // Ref: https://stackoverflow.com/questions/65383593/laravel-production-error-using-guzzle-http-to-get-url-status-code
        // -------------------------------------------------------------- //

        // $client = new Client();
        // try {
        //     $response = $client->request('GET', (string) $user->avatar, ['allow_redirects' => false, 'verify' => false]);
        // } catch(BadResponseException $e) {
        //     return "https://dummyimage.com/128x128/888ea8/ebedf2.png?text=No+Image+Found";
        // }
        //
        // if($response->getStatusCode() == 200) {
        //     return $user->avatar;
        // } else {
        //     return "https://dummyimage.com/128x128/888ea8/ebedf2.png?text=No+Image+Found";
        // }
    }

}
