<?php

namespace App\Listeners;

use App\Events\EventPeminjamanAlatUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PeminjamanAlatUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param EventPeminjamanAlatUpdated $event
     * @return void
     */
    public function handle(EventPeminjamanAlatUpdated $event): void
    {
        //
    }
}
