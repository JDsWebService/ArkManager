<?php

namespace App\Http\Controllers\Trade;

use Carbon\Carbon;
use App\Models\Auth\User;
use App\Handlers\FormHandler;
use App\Handlers\ItemHandler;
use App\Handlers\TradeHandler;
use App\Models\Trade\TradeItem;
use App\Models\Ark\ArkItemMetaInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TradeHubController extends Controller
{

    /**
     * Returns the selling item selection view
     *
     * @return mixed
     */
    public function newTrade() {
        $items = ArkItemMetaInfo::orderBy('name', 'asc')->get()->pluck('name', 'id');
        return view('trade.new.trade')
                ->withItems($items);
    }

    /**
     * Returns the configure item values trade form
     *
     * @param Request $request
     * @return mixed
     */
    public function configItems(Request $request) {
        $request = FormHandler::clean($request);
        $soldItem = ItemHandler::getItemByID($request->sold_item);
        $paymentItem = ItemHandler::getItemByID($request->payment_item);
        $itemQualities = ItemHandler::getItemQualities();
        return view('trade.new.config')
                ->withSoldItem($soldItem)
                ->withPaymentItem($paymentItem)
                ->withItemQualities($itemQualities);
    }

    /**
     * Returns the new trade summary view
     *
     * @param Request $request
     * @return mixed
     */
    public function tradeSummary(Request $request) {
        $request = FormHandler::clean($request);
        $validator = TradeHandler::validateTradeRequest($request);
        if($validator->fails()) {
            return redirect()
                ->route('trade.new.config.items', ['sold_item' => $request->sold_item, 'payment_item' => $request->payment_item])
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $soldItem = ItemHandler::getItemByID($request->sold_item);
        $paymentItem = ItemHandler::getItemByID($request->payment_item);
        return view('trade.new.summary')
                ->withRequest($request)
                ->withSoldItem($soldItem)
                ->withPaymentItem($paymentItem);
    }

    /**
     * Stores a new trade into the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeNewTrade(Request $request) {
        $request = FormHandler::clean($request);
        $validator = TradeHandler::validateTradeRequest($request);
        if($validator->fails()) {
            return redirect()
                ->route('trade.new.config.items', ['sold_item' => $request->sold_item, 'payment_item' => $request->payment_item])
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $trade = TradeHandler::storeNewTrade($request);

        if(!$trade) {
            Session::flash('danger', 'Something went wrong while saving the trade. Please try again. If the trade still gives you an error after trying again, please submit a bug report.');
            return redirect()->route('user.dashboard');
        }
        Session::flash('success', "You have added the trade successfully! You have {$trade->timeRemaining} left on your listing.");
        return redirect()->route('trade.index');
    }

    /**
     * Returns the index view of all public trades
     *
     * @return mixed
     */
    public function index() {
        $trades = TradeItem::orderBy('created_at', 'asc')->whereNull('deleted_at')->paginate(25);
        return view('trade.index')
                ->withTrades($trades);
    }

    /**
     * Returns a single trade view
     *
     * @param $uuid
     * @return mixed
     */
    public function view($uuid) {
        $user = User::where('id', Auth::user()->id)->first();
        $trade = TradeItem::where('uuid', $uuid)->firstOrFail();
        return view('trade.view')
                ->withTrade($trade);
    }

    /**
     * Returns the user's trade dashboard
     *
     * @return mixed
     */
    public function userIndex() {
        $activeTrades = TradeItem::where('user_id', Auth::user()->id)
                            ->whereNull('deleted_at')
                            ->paginate(10);
        $archivedTrades = TradeItem::where('user_id', Auth::user()->id)
                            ->whereNotNull('deleted_at')
                            ->paginate(10);
        return view('trade.user.index')
                    ->withActiveTrades($activeTrades)
                    ->withArchivedTrades($archivedTrades);
    }

    /**
     * Returns the edit trade view to the user
     *
     * @param $uuid
     * @return mixed
     */
    public function editTrade($uuid) {
        $trade = TradeItem::where('uuid', $uuid)->first();
        $itemQualities = ItemHandler::getItemQualities();
        return view('trade.edit.trade')
                    ->withTrade($trade)
                    ->withItemQualities($itemQualities);
    }

    /**
     * Returns the edit trade summary view to the user
     *
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editTradeSummary(Request $request, $uuid) {
        $trade = TradeItem::where('uuid', $uuid)->first();
        $request = FormHandler::clean($request);
        $validator = TradeHandler::validateTradeRequest($request);
        if($validator->fails()) {
            return redirect()
                ->route('trade.edit.trade', ['uuid' => $trade->uuid])
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $soldItem = ItemHandler::getItemByID($request->sold_item);
        $paymentItem = ItemHandler::getItemByID($request->payment_item);
        return view('trade.edit.summary')
            ->withRequest($request)
            ->withSoldItem($soldItem)
            ->withPaymentItem($paymentItem)
            ->withTrade($trade);
    }

    /**
     * Handles an update on a trade listing
     *
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeEditTrade(Request $request, $uuid) {
        $trade = TradeItem::where('uuid', $uuid)->first();
        $request = FormHandler::clean($request);
        $validator = TradeHandler::validateTradeRequest($request);
        if($validator->fails()) {
            return redirect()
                ->route('trade.edit.trade', ['uuid' => $trade->uuid])
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $trade = TradeHandler::storeUpdateTrade($request, $trade);

        if(!$trade) {
            Session::flash('danger', 'Something went wrong while saving the trade. Please try again. If the trade still gives you an error after trying again, please submit a bug report.');
            return redirect()->route('user.dashboard');
        }
        Session::flash('success', "You have edited the trade successfully! You have {$trade->timeRemaining} left on your listing.");
        return redirect()->route('trade.user.index');
    }

    /**
     * Renews a trade listing in the database.
     * This basically resets the timers on the trade.
     *
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function renew($uuid) {
        $trade = TradeItem::where('uuid', $uuid)->first();
        $trade->created_at = Carbon::now();
        $trade->updated_at = Carbon::now();
        $trade->deleted_at = null;
        $results = $trade->save();
        if(!$results) {
            Session::flash('danger', 'Something went wrong while saving the trade. Please try again. If the trade still gives you an error after trying again, please submit a bug report.');
            return redirect()->route('user.dashboard');
        }
        Session::flash('success', "You have renewed your the trade successfully! You have {$trade->timeRemaining} left on your listing.");
        return redirect()->route('trade.user.index');
    }

    /**
     * Deletes a listing from the database entirely
     *
     * @param $uuid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($uuid) {
        $trade = TradeItem::where('uuid', $uuid)->first();
        if($trade->isUserTradeOwner) {
            $trade->deleted_at = Carbon::now();
            $results = $trade->save();
            if(!$results) {
                Session::flash('danger', 'Something went wrong while deleting the trade. Please try again. If the trade still gives you an error after trying again, please submit a bug report.');
                return redirect()->route('user.dashboard');
            }
            Session::flash('success', "You have deleted the trade successfully!");
            return redirect()->route('trade.user.index');

        }
    }


}
