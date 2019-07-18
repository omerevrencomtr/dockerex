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

class ExchangeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $id;
    private $price;
    private $amount;
    private $key;
    private $direction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id = null, $price = null, $amount = null, $key = null, $direction = null)
    {
        $this->id = $id;
        $this->price = $price;
        $this->amount = $amount;
        $this->key = $key;
        $this->direction = $direction;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('exchange.' . $this->id);
    }

    public function broadcastWith()
    {

        return [
            'id' => $this->id,
            'price' => $this->price,
            'amount' => $this->amount,
            'key' => $this->key,
            'direction' => $this->direction,
        ];


    }
}
