<?php

namespace App\Events;

use App\Models\Exchange\Exchange;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HomeCurrencyStatesEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('home-currency-states');
    }

    public function broadcastWith()
    {
        $exchangeRates = Array();

        $exchanges = Exchange::where('active', 1)
            ->where('currency_buying_id', 'f32b2332-da55-4eb4-8e86-3b20aac09b58')
            ->orderBy('order', 'asc')
            ->get();

        foreach ($exchanges as $exchange) {
            $currency = $exchange->selling;
            $orderComplateds = $exchange->orderCompleteds()
                ->where('created_at', '>=', Carbon::now()->addHours(-24))
                ->orderby('created_at', 'asc')
                ->get();

            $id = $exchange->id;
            $buying_name = $exchange->buying->name;
            $name = $currency->name;
            $long_name = $currency->long_name;
            $color = $currency->color_code;
            $logo = $currency->logo;
            $volume = $orderComplateds->sum('amount');
            $high = $orderComplateds->max('price');
            $low = $orderComplateds->min('price');
            if ($orderComplateds->count() > 0) {
                $open = $orderComplateds->first()->price;
                $close = $orderComplateds->last()->price;
                $actual = $orderComplateds->last()->price;
                $actual24s = $orderComplateds->first()->price;
                $change24s = ($orderComplateds->last()->price - $orderComplateds->first()->price) / abs($orderComplateds->first()->price) * 100;

            } else {
                $open = 0;
                $close = 0;
                $actual = 0;
                $actual24s = 0;
                $change24s = 0;
            }

            $exchangeRates[] = (object)[
                'id' => $id,
                'name' => $name,
                'buying_name' => $buying_name,
                'long_name' => $long_name,
                'color' => $color,
                'logo' => $logo,
                'volume' => $volume,
                'high' => $high,
                'low' => $low,
                'actual' => $actual,
                'change24s' => $change24s
            ];
        }

        $exchanges = collect($exchangeRates);

        $orders = ExchangeOrder::select(DB::raw('SUM(amount) as amount'))
            ->addSelect('price', 'exchange_id', 'created_at', 'direction')
            ->orderby('created_at', 'DESC')
            ->groupby('price')
            ->limit(10)
            ->get();

        $last10Orders = Array();
        foreach ($orders as $order) {

            $buyingCurrency = $order->exchange->buying;
            $sellingCurrency = $order->exchange->selling;

            $last10Orders[] = (object)[
                'buying_name' => $buyingCurrency->name,
                'selling_name' => $sellingCurrency->name,
                'amount' => $order->amount,
                'price' => $order->price,
                'direction' => $order->direction,
                'created_at' => $order->createdDate(),
            ];
        }

        $lastOrders = collect($last10Orders);

        $announcements = AnnouncementPost::where('active', true)
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();

        return [
            'data' => 'asd',
        ];

        
    }
}
