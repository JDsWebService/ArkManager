<?php

namespace App\Handlers;

class ColorHandler {

    public static function getHexFromRGBA(array $computedRGBA)
    {
        return sprintf("%02x%02x%02x", $computedRGBA['R'], $computedRGBA['G'], $computedRGBA['B']);
    }

    public static function parseUnrealString($string)
    {
        // Define an empty array to store all the color channels
        $channels = [];
        $rgba = [];
        // Use REGEX to grab all color channels separately and then put into channels array
        preg_match_all('/([RGBA]=\d\.\d{6})/s', $string, $channels);
        // Loop through the RGBA values and extract the key value pairs
        foreach($channels[1] as $channel) {
            // Explode the pair from the channel
            $pair = explode("=", $channel);
            // Shove the key value pair into the RGBA array
            $rgba[$pair[0]] = $pair[1];
        }

        return $rgba;
    }

    public static function getRGBAFromUnreal(array $unrealRGBA)
    {
        // Define empty Computed RGBA Array
        $computedRGBA = [];

        // Formula = 255.999 * ($value ^ (1/2.2))
        $power = 1/2.2;

        // Loop through the array
        foreach($unrealRGBA as $key => $value) {
            $result = 255.999 * pow(floatval($value), $power);

            if($result > 255) {
                $result = 255;
            } elseif ($result < 0) {
                $result = 0;
            }

            $computedRGBA[$key] = (integer) $result;
        }

        return $computedRGBA;
    }

    public static function getINISearchString($string)
    {
        $regex = [];

        preg_match('/(.*\[\d\]=)(.*)/s', $string, $regex);

        return $regex[2];
    }
}
