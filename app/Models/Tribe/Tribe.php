<?php

namespace App\Models\Tribe;

use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany('App\Models\Auth\User');
    }

    /**
     * Defines the Official Ark Home Server relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function homeServer() {
        return $this->belongsTo('App\Models\Ark\ArkOfficialServer', 'home_server_id');
    }

    /**
     * Gets the member count of the tribe
     *
     * @return mixed
     */
    public function getMemberCountAttribute() {
        return User::where('tribe_id', $this->id)->get()->count();
    }

    /**
     * Returns a value based on if the authenticated user is
     * the tribe's owner.
     *
     * @return bool
     */
    public function getIsUserTribeOwnerAttribute() {
        return Auth::user()->id == $this->user_id;
    }

    /**
     * Defines the relationship between the tribe and the tribe application
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function application() {
        return $this->hasOne('App\Models\Tribe\Application', 'tribe_id');
    }

}
