<?php

namespace App\Models\Tribe;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * Defines the database table to be used by the model
     *
     * @var string
     */
    protected $table = 'user_tribe_applications';

    /**
     * Defines the tribe relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tribe() {
        return $this->belongsTo('App\Models\Tribe\Tribe');
    }

    /**
     * Defines the tribe owner relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tribeOwner() {
        return $this->belongsTo('App\Models\Auth\User');
    }

    /**
     * Defines the tribe home server relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function homeServer() {
        return $this->belongsTo('App\Models\Ark\ArkOfficialServer', 'home_server_id');
    }
}
