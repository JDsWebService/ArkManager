<?php

namespace App\Models\Dino;

use Illuminate\Database\Eloquent\Model;

class Dino extends Model
{
    // Define the table to be used
    protected $table = 'dinos';

    // Define the relationship between the tribe and the dino
    public function tribe() {
        return $this->belongsTo('App\Models\Tribe');
    }
}
