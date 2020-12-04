<?php

namespace App\Models\Trade;

use Carbon\Carbon;
use App\Models\Ark\ArkItemMetaInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class TradeItem extends Model
{
    /**
     * Defines the table to be used by the model
     *
     * @var string
     */
    protected $table = 'trades';

    /**
     * Gets the sold item and returns the item meta info
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soldItem() {
        return $this->belongsTo('App\Models\Ark\ArkItemMetaInfo', 'sold_item');
    }

    /**
     * Gets the payment item and returns the item meta info
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentItem() {
        return $this->belongsTo('App\Models\Ark\ArkItemMetaInfo', 'payment_item');
    }

    /**
     * Returns the user that posted the trade
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\Models\Auth\User');
    }

    /**
     * Returns the time remaining in the form of a DiffForHumans Carbon string
     *
     * @return string
     */
    public function getTimeRemainingAttribute() {
        return Carbon::parse($this->created_at)->addSeconds($this->duration)->diffForHumans();
    }

    /**
     * Returns true if the authenticated user is also the trade owner
     *
     * @return bool
     */
    public function getIsUserTradeOwnerAttribute() {
        if(Auth::user()->id == $this->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Returns true if the trade listing is expired/archived
     *
     * @return bool
     */
    public function getIsExpiredAttribute() {
        if($this->deleted_at != null) {
            return true;
        }
        return false;
    }
}
