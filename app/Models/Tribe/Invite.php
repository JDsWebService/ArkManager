<?php

namespace App\Models\Tribe;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    /**
     * Defines the table in the database to be used by the model
     *
     * @var string
     */
    protected $table = 'user_tribe_invites';

    /**
     * Defines the user that is receiving the invitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sentToUser() {
        return $this->belongsTo('App\Models\Auth\User', 'sent_to_user_id');
    }

    /**
     * Defines the user that is sending the invitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sentFromUser() {
        return $this->belongsTo('App\Models\Auth\User', 'sent-From_user_id');
    }

    /**
     * Defines the tribe that is associated with the invitation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tribe() {
        return $this->belongsTo('App\Models\Tribe\Tribe', 'tribe_id');
    }
}
