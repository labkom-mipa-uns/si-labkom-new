<?php

namespace App\Events;

use App\JasaInstallasi;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventJasaInstallasiSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $jasaInstallasi;

    /**
     * Create a new event instance.
     *
     * @param JasaInstallasi $jasaInstallasi
     */
    public function __construct(JasaInstallasi $jasaInstallasi)
    {
        $this->jasaInstallasi = $jasaInstallasi;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('jasa-installasi');
    }
}
