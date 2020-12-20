<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class SessionModel extends Model
{
    /**
     * Defines the table to be used by the model
     *
     * @var string
     */
    protected $table = 'sessions';
}
