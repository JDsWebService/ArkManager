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

    /**
     * Returns all the additions made on the model
     * instance within the instances major version
     *
     * @return mixed
     */
    public function getAddsAttribute() {
        return $this->where('major_version', $this->major_version)->where('change_type', 'add')->get();
    }

    /**
     * Returns all the changes made on the model
     * instance within the instances major version
     *
     * @return mixed
     */
    public function getChangesAttribute() {
        return $this->where('major_version', $this->major_version)->where('change_type', 'change')->get();
    }

    /**
     * Returns all the patches made on the model
     * instance within the instance major version
     *
     * @return mixed
     */
    public function getFixesAttribute() {
        return $this->where('major_version', $this->major_version)->where('change_type', 'fix')->get();
    }
}
