<?php

namespace App\Handlers;

use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class FormHandler
{

    /**
     * Cleans user supplied input using mews/Purifier.
     *
     * @param Request $request
     * @return Request
     */
    public static function clean(Request $request) {
        foreach($request->all() as $key => $value) {
            $request->{$key} = Purifier::clean($value);
        }
        return $request;
    }
}
