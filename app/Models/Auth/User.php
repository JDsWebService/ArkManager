<?php

namespace App\Models\Auth;

use Carbon\Carbon;
use App\Models\Trade\TradeItem;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Defines the table that is used by this model.
     *
     * @var string
     */
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define the relationship between the user model and the tribe model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tribe() {
        return $this->hasOne('App\Models\Tribe\Tribe');
    }

    /**
     * Get the member since attribute
     * @return string
     */
    public function getMemberSinceAttribute() {
        return Carbon::parse($this->created_at)->format('m/d/Y');
    }

    /**
     * Returns a paginated result of all of a users active trades
     *
     * @return mixed
     */
    public function getTradesAttribute() {
        return TradeItem::where('user_id', $this->id)->whereNull('deleted_at')->paginate(5);
    }

    public function getIsAdminAttribute() {
        if($this->admin) {
            return true;
        }
        return false;
    }
}
