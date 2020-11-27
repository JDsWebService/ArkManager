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

    /**
     * Defines the relationship between the user model and the tribe model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\Models\Auth\User');
    }

    /**
     * Defines the relationship between the tribe and the Base Dino model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function baseDinos() {
        return $this->hasMany('App\Models\Dino\BaseDino');
    }
}
