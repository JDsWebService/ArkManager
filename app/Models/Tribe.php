<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tribe extends Model
{
    // Define the table to be used in the database
    protected $table = 'tribes';

    // Define the relationship between the user model and tribe model
    public function user() {
        return $this->belongsTo('App\Models\Auth\User');
    }

    // Define the relationship between the dino model and the tribe model
    public function dinos() {
        return $this->hasMany('App\Models\Dino\Dino');
    }
}
