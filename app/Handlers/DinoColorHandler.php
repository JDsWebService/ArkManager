<?php

namespace App\Handlers;

use App\Models\Ark\ArkDinoColor;
use App\Models\Dino\UserDinoColor;
use App\Models\Ark\ArkDinoMetaInfo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\DinoColorHandlerException;

class DinoColorHandler
{

    /**
     * Validates if the file uploaded by the user is
     * of the INI file mime-type
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @throws DinoColorHandlerException
     */
    public static function validateFileIsIni(\Illuminate\Http\UploadedFile $file)
    {
        if($file->getClientOriginalExtension() != 'ini') {
            throw new DinoColorHandlerException("The file you uploaded is not an INI file. Please upload an INI file.");
        }
    }

    /**
     * Parses the INI file supplied by the user
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return array
     * @throws DinoColorHandlerException
     */
    public static function parse(\Illuminate\Http\UploadedFile $file)
    {
        $data = [];
        $contents = str_replace("\r", '', File::get($file));
        $data['ark_dino_id'] = self::getArkDinoId($contents);
        if(Auth::user()->tribe_sees_dinos == true) {
            $data['tribe_id'] = TribeHandler::getTribeID();
        }
        $data['user_id'] = Auth::user()->id;
        $data['dino_id_one'] = self::getDinoIdOne($contents);
        $data['dino_id_two'] = self::getDinoIdTwo($contents);
        $data['gender'] = self::getDinoGender($contents);
        $data['level'] = self::getDinoLevel($contents);
        $data['health'] = self::getDecimalStat($contents, 'health');
        $data['stamina'] = self::getDecimalStat($contents, 'stamina');
        $data['torpidity'] = self::getDecimalStat($contents, 'torpidity');
        $data['oxygen'] = self::getDecimalStat($contents, 'oxygen');
        $data['food'] = self::getDecimalStat($contents, 'food');
        $data['water'] = self::getDecimalStat($contents, 'water');
        $data['temperature'] = self::getDecimalStat($contents, 'temperature');
        $data['weight'] = self::getDecimalStat($contents, 'weight');
        $data['damage'] = self::getPercentageStat($contents, 'melee damage');
        $data['movement'] = self::getPercentageStat($contents, 'movement speed');
        $data['fortitude'] = self::getDecimalStat($contents, 'fortitude');
        $data['crafting'] = self::getPercentageStat($contents, 'crafting skill');
        $data['region_zero_id'] = self::getRegionColor($contents, 0);
        $data['region_one_id'] = self::getRegionColor($contents, 1);
        $data['region_two_id'] = self::getRegionColor($contents, 2);
        $data['region_three_id'] = self::getRegionColor($contents, 3);
        $data['region_four_id'] = self::getRegionColor($contents, 4);
        $data['region_five_id'] = self::getRegionColor($contents, 5);

        return $data;
    }

    /**
     * Gets the ark dino meta info id
     *
     * @param string $contents
     * @return mixed
     * @throws DinoColorHandlerException
     */
    private static function getArkDinoId(string $contents)
    {
        $output = [];
        preg_match('/DinoClass\=(\/\w{1,}){1,}\.(\w{1,})/i', $contents, $output);
        $dino = ArkDinoMetaInfo::where('ark_id', $output[2])->first();
        if($dino == null) {
            throw new DinoColorHandlerException("Can not find the dino by class name: {$output[2]}. Take a screenshot of this error message and then open a ticket in our discord to get some help.");
        }
        return $dino->id;
    }

    /**
     * Gets the first dino ID from the file
     *
     * @param string $contents
     * @return mixed
     */
    private static function getDinoIdOne(string $contents)
    {
        $output = [];
        preg_match('/DinoID1\=(.*)/', $contents, $output);
        return ($output[1] == "0.000000") ? 0 : $output[1];
    }

    /**
     * Gets the second dino ID from file
     * @param string $contents
     * @return mixed
     */
    private static function getDinoIdTwo(string $contents)
    {
        $output = [];
        preg_match('/DinoID2\=(.*)/', $contents, $output);
        return ($output[1] == "0.000000") ? 0 : $output[1];
    }

    /**
     * Gets the gender of the dino from file
     * @param string $contents
     * @return string
     */
    private static function getDinoGender(string $contents)
    {
        $output = [];
        preg_match('/bIsFemale\=(.*)/', $contents, $output);
        switch($output[1]) {
            case "False":
                return "male";
                break;
            case "True":
                return "female";
                break;
            default:
                return "unknown";
                break;
        }
    }

    /**
     * Gets the dinos level from the file
     *
     * @param string $contents
     * @return mixed
     */
    private static function getDinoLevel(string $contents)
    {
        $output = [];
        preg_match('/CharacterLevel\=(.*)/', $contents, $output);
        return ($output[1] == "0.000000") ? 0 : $output[1];
    }

    /**
     * Gets the color id from ark_dino_colors table based on contents
     * of ini file for that region
     *
     * @param string $contents
     * @param int $colorRegion
     * @return int
     */
    private static function getRegionColor(string $contents, int $colorRegion)
    {
        $output = [];
        preg_match("/ColorSet\[{$colorRegion}\]=(.*)/i", $contents, $output);
        $inistring = $output[1];
        $color = ArkDinoColor::where('inistring', $inistring)->first();
        return ($color == null) ? 0 : $color->id;
    }

    /**
     * Gets a decimal stat value.
     * I.e. Health, Stamina, Weight, etc.
     *
     * @param string $contents
     * @param string $stat
     * @return int|mixed
     */
    private static function getDecimalStat(string $contents, string $stat)
    {
        $output = [];
        preg_match("/{$stat}\=(.*)/i", $contents, $output);
        return ($output[1] == "0.000000") ? 0 : $output[1];
    }

    /**
     * Gets a percentage based stat value.
     * I.e. Melee Damage, Crafting Skill, Movement Speed
     *
     * @param string $contents
     * @param string $stat
     * @return int|string
     */
    private static function getPercentageStat(string $contents, string $stat)
    {
        $output = [];
        preg_match("/{$stat}\=(.*)/i", $contents, $output);
        $value = ltrim(substr(str_replace('.', '', $output[1]), 0, -4), '0');
        return ($value == "") ? 0 : $value;
    }

    /**
     * Saves the dino into the database
     *
     * @param array $data
     */
    public static function saveDinoToDatabase(array $data)
    {
        $coloredDino = new UserDinoColor;

        foreach($data as $key => $value) {
            $coloredDino->{$key} = $value;
        }
        $coloredDino->save();
    }

    /**
     * Updates colored dinos based on user settings
     *
     * @param $user
     */
    public static function updateUserDinosTribeSettings($user)
    {
        $dinos = UserDinoColor::where('user_id', $user->id)->get();
        foreach($dinos as $dino) {
            ($user->tribe_sees_dinos == false) ? $dino->tribe_id = null : $dino->tribe_id = $user->tribe->id;
            $dino->save();
        }
    }

    /**
     * Gets the region ids for the supplie dinos collection
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $dinos
     * @param string $region
     * @return array
     */
    public static function getRegionIdsForDinos(\Illuminate\Pagination\LengthAwarePaginator $dinos, string $region)
    {
        $regionGroup = $dinos->groupBy("region_{$region}_id");
        $regionIds = [];
        foreach($regionGroup as $id => $dinos) {
            array_push($regionIds, $id);
        }
        return $regionIds;
    }


}
