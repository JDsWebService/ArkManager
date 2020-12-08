<?php

namespace App\Models\Admin\Logs;

use App\Handlers\ChangelogHandler;
use Illuminate\Database\Eloquent\Model;

class Changelog extends Model
{
    /**
     * Defines the table to be used by the model
     *
     * @var string
     */
    protected $table = 'changelogs';

    /**
     * Gets the prettified version of the changelog category
     *
     * @param $attributeValue
     * @return string
     */
    public function getCategoryAttribute($attributeValue) {
        $categories = ChangelogHandler::getCategories();
        foreach($categories as $category => $value) {
            if($attributeValue == $category) {
                return $value;
            }
        }
        return "Category Error";
    }

    /**
     * Gets the prettified version of the change type attribute
     *
     * @param $attributeValue
     * @return string
     */
    public function getChangeTypeAttribute($attributeValue) {
        switch($attributeValue) {
            case "add":
                return "Add";
            case "fix":
                return "Fix";
            case "change":
                return "Change";
            default:
                return "Change Type Error";
        }
    }

    /**
     * Gets the prettified version of the version type attribute
     *
     * @param $attributeValue
     * @return string
     */
    public function getVersionTypeAttribute($attributeValue) {
        switch($attributeValue) {
            case "major":
                return "Major";
            case "minor":
                return "Minor";
            case "patch":
                return "Patch";
            default:
                return "Version Type Error";
        }
    }
}
