<?php

namespace App\Http\Controllers\Dashboard\Exchange;

use App\Models\Currency\Currency;
use App\Models\Exchange\Exchange;
use App\Models\Exchange\ExchangeCommission;
use App\Models\Exchange\ExchangeOrder;
use App\Models\Exchange\ExchangeOrderCompleted;
use App\Models\User\UserBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;

class ExchangeController extends Controller
{


    public function sell($buying_name, $selling_name, Request $request)
    {


       



        $user = Auth::user();

        $amount = floatval($request->amount);
        $price = floatval($request->price);

       
        $takerCommission = 0;
        $makerCommission = 0;

        $exchange = Exchange::select('id', 'currency_buying_name', 'currency_selling_name', 'currency_buying_id', 'currency_selling_id','min_trade_amount','min_trade_price')
                ->where('currency_buying_name', $buying_name)
                ->where('currency_selling_name', $selling_name)
                ->where('active', true)
                ->first() ?? abort(404);
 broadcast(new \App\Events\ExchangeEvent($exchange->id,$price,$amount,'remove','buy'));

        if ($exchange->min_trade_amount > $amount || $exchange->min_trade_price > $price){
            return response()->json(['errors'=>['Girilen emir değerleri minumun emir değerinin altında']],422);
        }


        $balance = UserBalance::where('user_id', $user->id)
            ->where('currency_id', $exchange->currency_buying_id)
            ->where('balance', '>=', $amount)
            ->first();


        if (!$balance) {
            return response()->json(['errors' => ['Bakiyeniz bu işlem için yetersiz']], 422);
        } else {
            $balance->balance = $balance->balance - $amount;
            $balance->save();
        }


        if ($user->taker_commission == true && $user->maker_commission == true) {
            $takerCommission = $user->taker_commission;
            $makerCommission = $user->maker_commission;

        } else {
            $now = Carbon::now();
            $to = Carbon::now()->subDays(30);

            $orderTotalBuy = ExchangeOrderCompleted::select(DB::raw('(amount*price)-commission as total'))
                ->where('exchange_id', $exchange->id)
                ->where('created_at', '<=', $now)
                ->where('created_at', '>=', $to)
                ->where('user_buying_id', $user->id)
                ->get()->sum('total');

            $orderTotalSell = ExchangeOrderCompleted::select(DB::raw('(amount*price)-commission as total'))
                ->where('exchange_id', $exchange->id)
                ->where('created_at', '<=', $now)
                ->where('created_at', '>=', $to)
                ->where('user_selling_id', $user->id)
                ->get()->sum('total');


            $orderTotal = $orderTotalBuy + $orderTotalSell;

            $commissions = ExchangeCommission::select('min', 'max', 'maker', 'taker')->where('exchange_id', $exchange->id)->orderby('min', 'ASC')->get();

            foreach ($commissions as $commission) {

                if ($commission->min <= $orderTotal && $commission->max >= $orderTotal) {
                    $takerCommission = $commission->taker;
                    $makerCommission = $commission->maker;
                }
            }
        }


        $orders = ExchangeOrder::where('exchange_id', $exchange->id)->where('direction', 'buy')->where('price', '>=', $price)->orderby('price', 'ASC')->orderby('created_at', 'ASC')->get();

        if ($orders->count() > 0) {

        }

        $maker = new ExchangeOrder();
        $maker->exchange_id = $exchange->id;
        $maker->user_id = $user->id;
        $maker->price = $price;
        $maker->amount = $amount;
        $maker->commission = $makerCommission;
        $maker->direction = 'sell';
        $maker->amount = $amount;
        $maker->price = $price;

        $maker->save();

        return response()->json(['errors' => ['test']], 422);
    }


    public function buy(Request $request)
    {

        return response()->json(['message' => 'success'], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($currency_buying_name = null, $currency_selling_name = null)
    {
        $user = Auth::user();

        $exchange = Exchange::select('id', 'actual_price', 'buy_price', 'sell_price', 'low_price', 'high_price', 'change_percent', 'volume', 'currency_buying_id', 'currency_selling_id', 'currency_buying_name', 'currency_selling_name')->where('currency_buying_name', $currency_buying_name)
                ->where('currency_selling_name', $currency_selling_name)
                ->where('active', true)
                ->first() ?? abort(404);

        $commissions = ExchangeCommission::select('min', 'max', 'maker', 'taker')->where('exchange_id', $exchange->id)->orderby('min', 'ASC')->get();


        $buyingOrders = $exchange->buyingOrders;
        $sellingOrders = $exchange->sellingOrders;

        $currencyBuying = Currency::where('id', $exchange->currency_buying_id)
                ->first() ?? abort(404);

        $currencySelling = Currency::where('id', $exchange->currency_selling_id)
                ->first() ?? abort(404);;

        $buyingBalance = UserBalance::where('user_id', $user->id)->where('currency_id', $currencyBuying->id)->first();

        $sellingBalance = UserBalance::where('user_id', $user->id)->where('currency_id', $currencySelling->id)->first();


        $now = Carbon::now();
        $to = Carbon::now()->subDays(30);


        $orderTotalBuy = ExchangeOrderCompleted::select(DB::raw('(amount*price)-commission as total'))
            ->where('exchange_id', $exchange->id)
            ->where('created_at', '<=', $now)
            ->where('created_at', '>=', $to)
            ->where('user_buying_id', $user->id)
            ->get()->sum('total');

        $orderTotalSell = ExchangeOrderCompleted::select(DB::raw('(amount*price)-commission as total'))
            ->where('exchange_id', $exchange->id)
            ->where('created_at', '<=', $now)
            ->where('created_at', '>=', $to)
            ->where('user_selling_id', $user->id)
            ->get()->sum('total');


        $orderTotal = $orderTotalBuy + $orderTotalSell;
        $orderTotal = number_format($orderTotal, 8, '.', '');

        $buyDepth = ExchangeOrder::select('amount', DB::raw('(amount*price) as total'))
            ->where('exchange_id', $exchange->id)
            ->where('direction', 'buy')
            ->get();
        $sellDepth = ExchangeOrder::select('amount', DB::raw('(amount*price) as total'))
            ->where('exchange_id', $exchange->id)
            ->where('direction', 'sell')
            ->get();;
        return view('dashboard.exchange.index', compact('buyDepth', 'sellDepth', 'orderTotal', 'buyingBalance', 'sellingBalance', 'commissions', 'exchange', 'buyingOrders', 'sellingOrders', 'currencyBuying', 'currencySelling'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
