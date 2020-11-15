<?php

namespace App\Models\Ark;

use Illuminate\Database\Eloquent\Model;

class Dino extends Model
{
    /**
     * Define the table to be used by the model
     *
     * @var string
     */
    protected $table = 'ark_dinos';

    public function lines() {
        return $this->hasMany('App\Models\User\Dino\Line');
    }
}
