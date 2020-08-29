<?php

namespace App\Events;

use App\JasaPrint;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventJasaPrintUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $jasaPrint;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(JasaPrint $jasaPrint)
    {
        $this->jasaPrint = $jasaPrint;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('jasa-print');
    }
}
