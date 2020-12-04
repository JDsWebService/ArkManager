<?php

namespace App\Models\Ark;

use Illuminate\Database\Eloquent\Model;

class ArkItemMetaInfo extends Model
{
    /**
     * The database table to be used by the model
     *
     * @var string
     */
    protected $table = 'ark_item_meta_info';

    /**
     * If the item has a quality attribute associated with it.
     * Ref: https://ark.gamepedia.com/Item_Quality
     *
     * @return bool
     */
    public function getHasQualityAttribute() {
        switch($this->type) {
            case "Weapon":
            case "Tool":
            case "Armor":
            case "Saddle":
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * If the item has an armor values associated with it.
     *
     * @return bool
     */
    public function getHasArmorAttribute() {
        switch($this->type) {
            case "Armor":
            case "Saddle":
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * If an item has hyopthermic and hyperthermic temperature resistance.
     *
     * @return bool
     */
    public function getHasTemperatureAttribute() {
        switch($this->type) {
            case "Armor":
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * If the item has a durability attribute associated with it.
     *
     * @return bool
     */
    public function getHasDurabilityAttribute() {
        switch($this->type) {
            case "Armor":
            case "Weapon":
            case "Tool":
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * If the item has a durability attribute associated with it.
     *
     * @return bool
     */
    public function getHasDamageAttribute() {
        switch($this->type) {
            case "Tool":
            case "Weapon":
                return true;
                break;
            default:
                return false;
                break;
        }
    }

    public function getHasBlueprintAttribute() {
        switch($this->type) {
            case "Farming":
            case "Tool":
            case "Armor":
            case "Saddle":
            case "Structure":
            case "Weapon":
            case "Attachment":
            case "Ammunition":
                return true;
                break;
            default:
                return false;
                break;
        }
    }
}
