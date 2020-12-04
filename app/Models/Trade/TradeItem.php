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
     * Does the trade's sold item have quality
     *
     * @return bool
     */
    public function getSoldHasQualityAttribute() {
        if($this->sold_quality != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades sold item have armor
     *
     * @return bool
     */
    public function getSoldHasArmorAttribute() {
        if($this->sold_armor != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades sold item have temperature values
     * @return bool
     */
    public function getSoldHasTemperatureAttribute() {
        if($this->sold_hypothermic != null && $this->sold_hyperthermic != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades sold item have damage
     *
     * @return bool
     */
    public function getSoldHasDamageAttribute() {
        if($this->sold_damage != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades sold item have durability
     *
     * @return bool
     */
    public function getSoldHasDurabilityAttribute() {
        if($this->sold_durability != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades sold item have a blueprint
     *
     * @return bool
     */
    public function getSoldHasBlueprintAttribute() {
        if($this->sold_blueprint) {
            return true;
        }
        return false;
    }

    /**
     * Does the trade's payment item have quality
     *
     * @return bool
     */
    public function getPaymentHasQualityAttribute() {
        if($this->payment_quality != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades payment item have armor
     *
     * @return bool
     */
    public function getPaymentHasArmorAttribute() {
        if($this->payment_armor != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades payment item have temperature values
     * @return bool
     */
    public function getPaymentHasTemperatureAttribute() {
        if($this->payment_hypothermic != null && $this->payment_hyperthermic != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades payment item have damage
     *
     * @return bool
     */
    public function getPaymentHasDamageAttribute() {
        if($this->payment_damage != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades payment item have durability
     *
     * @return bool
     */
    public function getPaymentHasDurabilityAttribute() {
        if($this->payment_durability != null) {
            return true;
        }
        return false;
    }

    /**
     * Does the trades payment item have a blueprint
     *
     * @return bool
     */
    public function getPaymentHasBlueprintAttribute() {
        if($this->payment_blueprint) {
            return true;
        }
        return false;
    }

    /**
     * Returns true if the authenticated user is also the trade owner
     *
     * @return bool
     */
    public function getIsUserTradeOwnerAttribute() {
        $user = Auth::user();
        if($user->id = $this->user_id) {
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
