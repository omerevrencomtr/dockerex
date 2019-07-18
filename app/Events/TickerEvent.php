<?php

namespace App\Events;

use App\Models\Exchange\Exchange;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TickerEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id=$id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ticker');
    }

    public function broadcastWith()
    {

        $exchange=Exchange::select('id','currency_selling_id','currency_buying_id','actual_price','change_percent','high_price','low_price','volume')->where('id',$this->id)->first();

        $data= new \stdClass();
        $data->id = $exchange->id;
        $data->actual_price = number_format($exchange->actual_price,$exchange->selling->decimal,'.',',');
        $data->change_percent = number_format($exchange->change_percent,$exchange->selling->decimal,'.',',');
        $data->high_price = number_format($exchange->high_price,$exchange->selling->decimal,'.',',');
        $data->low_price = number_format($exchange->low_price,$exchange->selling->decimal,'.',',');
        $data->volume = number_format($exchange->volume,$exchange->selling->decimal,'.',',');



        return [
            'ticker'=>$data,
        ];


    }
}
