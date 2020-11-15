<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Tribe extends Model
{
    /**
     * Define the table to be used by the model
     *
     * @var string
     */
    protected $table = 'user_tribes';

    // Define the relationship between the user model and tribe model
    public function user() {
        return $this->belongsTo('App\Models\Auth\User');
    }

    public function breedingLines() {
        return $this->hasMany('App\Models\User\Dino\Line');
    }
}
