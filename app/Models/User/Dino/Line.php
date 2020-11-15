<?php

namespace App\Models\User\Dino;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    /**
     * Define the table to be used by the model
     *
     * @var string
     */
    protected $table = 'user_breeding_lines';

    public function tribe() {
        return $this->belongsTo('App\Models\User\Tribe');
    }

    public function dino() {
        return $this->belongsTo('App\Models\Ark\Dino', 'ark_dino_id');
    }

    public function getMutationTypeAttribute($value) {
        return Str::title($value);
    }
}
