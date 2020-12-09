<?php

namespace App\Models\Documentation;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    /**
     * Defines the table to be used by the model
     *
     * @var string
     */
    protected $table = "documentation";

    /**
     * Returns a title case value for the category
     *
     * @param $value
     * @return string
     */
    public function getCategoryAttribute($value) {
        return Str::title($value);
    }
}
