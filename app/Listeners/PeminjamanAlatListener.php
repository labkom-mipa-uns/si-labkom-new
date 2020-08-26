<?php

namespace App\Listeners;

use App\Events\EventPeminjamanAlat;
use App\Transaksi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PeminjamanAlatListener
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
     * @param EventPeminjamanAlat $event
     * @return void
     */
    public function handle(EventPeminjamanAlat $event): void
    {
        $peminjamanAlat = $event->getPeminjamanAlat();
        Transaksi::create([
            'id_peminjaman_alat' => $peminjamanAlat->id,
            'id_jasa_installasi' => null,
            'id_jasa_print' => null,
            'kategori' => 'peminjaman_alat',
            'harga' => $peminjamanAlat->alat->harga_alat,
            'jumlah' => $peminjamanAlat->jumlah_pinjam,
            'total_bayar' => (int)$peminjamanAlat->jumlah_pinjam * (int)$peminjamanAlat->alat->harga_alat,
            'tanggal' => $peminjamanAlat->tanggal_pinjam,
        ]);
    }
}
