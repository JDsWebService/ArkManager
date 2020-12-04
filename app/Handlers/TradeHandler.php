<?php

namespace App\Handlers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Trade\TradeItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class TradeHandler
{

    /**
     * Validates the trade request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validateTradeRequest(Request $request)
    {
        $validator = Validator::make($request->all(),
            self::getTradeValidationRules());
        $validator->setAttributeNames(self::getValidationAttributeNames());
        return $validator;
    }

    /**
     * Gets the trade request validation rules
     *
     * @return string[]
     */
    private static function getTradeValidationRules()
    {
        return [
            'sold_item' => 'required|integer',
            'sold_quantity' => 'required|integer|min:1',
            'sold_blueprint' => 'sometimes|required|in:1,0',
            'sold_quality' => 'sometimes|required|in:primitive,ramschackle,apprentice,journeyman,mastercraft,ascendant',
            'sold_armor' => 'sometimes|required|numeric|min:1',
            'sold_hypothermic' => 'sometimes|required|numeric|min:1',
            'sold_hyperthermic' => 'sometimes|required|numeric|min:1',
            'sold_damage' => 'sometimes|required|numeric|min:1',
            'sold_durability' => 'sometimes|required|integer|min:1',
            'payment_item' => 'required|integer',
            'payment_quantity' => 'required|integer|min:1',
            'payment_blueprint' => 'sometimes|required|in:1,0',
            'payment_quality' => 'sometimes|required|in:primitive,ramschackle,apprentice,journeyman,mastercraft,ascendant',
            'payment_armor' => 'sometimes|required|numeric|min:1',
            'payment_hypothermic' => 'sometimes|required|numeric|min:1',
            'payment_hyperthermic' => 'sometimes|required|numeric|min:1',
            'payment_damage' => 'sometimes|required|numeric|min:1',
            'payment_durability' => 'sometimes|required|integer|min:1',
            'bartering_allowed' => 'sometimes|required|in:1,0'
        ];
    }

    /**
     * Validation Attributes commonly used with trade transactions
     *
     * @return string[]
     */
    private static function getValidationAttributeNames()
    {
        return [
            'sold_item' => 'Sold Item',
            'sold_quantity' => 'Sold Item Quantity',
            'sold_blueprint' => 'Sold Item Blueprint Status',
            'sold_quality' => 'Sold Item Quality',
            'sold_armor' => 'Sold Item Armor Value',
            'sold_hypothermic' => 'Sold Item Hypothermic Value',
            'sold_hyperthermic' => 'Sold Item Hypothermic Value',
            'sold_damage' => 'Sold Item Damage Value',
            'sold_durability' => 'Sold Item Durability Value',
            'payment_item' => 'Payment Item',
            'payment_quantity' => 'Payment Item Quantity',
            'payment_blueprint' => 'Payment Item Blueprint Status',
            'payment_quality' => 'Payment Item Quality',
            'payment_armor' => 'Payment Item Armor Value',
            'payment_hypothermic' => 'Payment Item Hypothermic Value',
            'payment_hyperthermic' => 'Payment Item Hypothermic Value',
            'payment_damage' => 'Payment Item Damage Value',
            'payment_durability' => 'Payment Item Durability Value',
        ];
    }

    /**
     * Stores a new trade into the trades table
     *
     * @param Request $request
     * @return TradeItem
     */
    public static function storeNewTrade(Request $request)
    {
        $trade = new TradeItem;
        $trade = self::assignRequestToTradeItemInstance($trade, $request);
        $trade->save();
        return $trade;
    }

    /**
     * Handles all of the column fields for the TradeItem model,
     * and inserts the request into the TradeItem instance.
     *
     * @param TradeItem $trade
     * @param Request $request
     * @return TradeItem
     */
    private static function assignRequestToTradeItemInstance(TradeItem $trade, Request $request)
    {
        // Handle all the static content
        $trade->user_id = Auth::user()->id;
        $trade->duration = 28800;
        $trade->promoted = false;
        $trade->uuid = Str::uuid()->toString();

        // Handle all the misc column names
        $tradeItemColumns = Schema::getColumnListing('trades');
        foreach($tradeItemColumns as $column) {
            if(isset($request->{$column})) {
                $trade->{$column} = $request->{$column};
            }
        }
        return $trade;
    }

    /**
     * Stores an update on a trade instance
     *
     * @param Request $request
     * @param $trade
     * @return TradeItem
     */
    public static function storeUpdateTrade(Request $request, $trade)
    {
        $trade = self::assignRequestToTradeItemInstance($trade, $request);
        $trade->save();
        return $trade;
    }
}
