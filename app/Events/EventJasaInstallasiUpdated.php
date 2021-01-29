<?php

namespace App\Events;

use App\Models\JasaInstallasi;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventJasaInstallasiUpdated
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
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('jasa-installasi');
    }
}
