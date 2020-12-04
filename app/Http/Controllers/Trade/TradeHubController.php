<?php

namespace App\Http\Controllers\Trade;

use App\Handlers\FormHandler;
use App\Handlers\ItemHandler;
use App\Handlers\TradeHandler;
use App\Models\Trade\TradeItem;
use App\Models\Ark\ArkItemMetaInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $duration = gmdate("H:i:s", $trade->duration);
        Session::flash('success', "You have added the trade successfully! Your listing will be seen for {$duration}. (Hours : Minutes : Seconds)");
        return redirect()->route('user.dashboard');
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

    public function view($uuid) {
        $trade = TradeItem::where('uuid', $uuid)->firstOrFail();
        return view('trade.view')
                ->withTrade($trade);
    }



}
