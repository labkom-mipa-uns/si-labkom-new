<?php

namespace App\Listeners;

use App\Alat;
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
        $peminjamanAlat = $event->peminjamanAlat;
        if ($peminjamanAlat->status === '1') {
            Alat::whereId($peminjamanAlat->alat->id)->update([
                'stok_alat' => $peminjamanAlat->alat->stok_alat + $peminjamanAlat->jumlah_pinjam
            ]);
        }
    }
}
