<?php

namespace App\Handlers;

use App\Models\Dino\Color;
use App\Exceptions\DinoHandlerException;
use App\Models\Dino\Dino;

class DinoHandler {

    public static function parseIni($file = null) {
        if(!$file) {
            throw new DinoHandlerException('No File Specified');
        }

        $r = parse_ini_string(trim($file), true, INI_SCANNER_RAW);

        $dinoData = (object) $r['Dino Data'];
        $dinoColors = (object) $r['Colorization']['ColorSet'];
        $dinoStats = (object) $r['Max Character Status Values'];
        $dinoAncestry = (object) $r['Dino Ancestry'];

        $data = [
            'name' => $dinoData->TamedName,
            'type' => $dinoData->DinoNameTag,
            'gender' => self::getGender($dinoData->bIsFemale),
            'level' => $dinoData->CharacterLevel,
            'health' => $dinoStats->Health,
            'stamina' => $dinoStats->Stamina,
            'oxygen' => $dinoStats->Oxygen,
            'food' => $dinoStats->food,
            'water' => $dinoStats->Water,
            'weight' => $dinoStats->Weight,
            'damage' => $dinoStats->{'Melee Damage'},
            'movement' => $dinoStats->{'Movement Speed'},
            'torpidity' => $dinoStats->Torpidity,
            'fortitude' => $dinoStats->Fortitude,
            'crafting' => $dinoStats->{'Crafting Skill'},
            'tamedBy' => $dinoData->TamerString,
            'class' => $dinoData->DinoClass,
            'imprintedBy' => $dinoData->ImprinterName,
        ];

        $colors = self::parseColors($dinoColors);
        foreach($colors as $key => $id) {
            $data['color_id_region_' . $key] = $id;
        }

        return $data;
    }

    /**
     * Returns Male or Female based on boolean value
     * @param $bIsFemale
     * @return string
     */
    private static function getGender($bIsFemale)
    {
        return ($bIsFemale == true) ? 'female' : 'male';
    }

    private static function parseColors(object $dinoColors)
    {
        // Define Colors Array
        $colors = [];

        // Loop through each color region
        foreach($dinoColors as $region) {
            // Grab the color from the database
            $color = Color::where('iniString', $region)->firstOrFail();
            if($color != null) {
                array_push($colors, $color->colorID);
            }

        }
        return $colors;
    }

}
