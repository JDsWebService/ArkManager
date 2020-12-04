<?php

namespace App\Handlers;

use App\Models\Ark\ArkItemMetaInfo;

class ItemHandler
{

    /**
     * Returns the item quality levels in array format
     *
     * @return string[]
     */
    public static function getItemQualities()
    {
        return [
            "primitive" => "Primitive",
            "ramshackle" => "Ramschakle",
            "apprentice" => "Apprentice",
            "journeyman" => "Journeyman",
            "mastercraft" => "Mastercraft",
            "ascendant" => "Ascendant",
        ];
    }

    /**
     * Finds the item meta data by ID column
     *
     * @param $itemID
     * @return mixed
     */
    public static function getItemByID($itemID)
    {
        return ArkItemMetaInfo::where('id', $itemID)->firstOrFail();
    }

    /**
     * Returns an array of all item types in the database.
     *
     * @return array
     */
    public static function getItemTypes() {
        $typesArray = [];
        $items = ArkItemMetaInfo::select('type')->groupBy('type')->get();
        foreach($items as $item) {
            array_push($typesArray, $item->type);
        }
        return $typesArray;
    }
}
