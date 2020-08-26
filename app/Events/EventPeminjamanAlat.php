<?php

namespace App\Events;

use App\PeminjamanAlat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventPeminjamanAlat
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $peminjamanAlat;

    /**
     * Create a new event instance.
     *
     * @param PeminjamanAlat $peminjamanAlat
     */
    public function __construct(PeminjamanAlat $peminjamanAlat)
    {
        $this->peminjamanAlat = $peminjamanAlat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('peminjaman-alat');
    }

    /**
     * @return PeminjamanAlat
     */
    public function getPeminjamanAlat(): PeminjamanAlat
    {
        return $this->peminjamanAlat;
    }

}
