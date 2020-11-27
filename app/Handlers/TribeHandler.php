<?php


namespace App\Handlers;

use App\Exceptions\TribeException;
use Illuminate\Support\Facades\Auth;

class TribeHandler
{

    public static function getTribe() {
        return Auth::user()->tribe;
    }

    public static function getStatInputSettings() {
        $tribe = self::getTribe();
        if($tribe->use_true_values == true) {
            return 'true_values';
        } else {
            return 'stat_levels';
        }
        throw new TribeException('Unable to get Stat Input Tribe Settings. Error Code: 0001');
    }
}
