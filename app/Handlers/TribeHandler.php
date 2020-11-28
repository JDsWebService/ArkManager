<?php


namespace App\Handlers;

use App\Exceptions\TribeException;
use Illuminate\Support\Facades\Auth;

class TribeHandler
{
    public static function getTribeID() {
        return Auth::user()->tribe->id;
    }
}
