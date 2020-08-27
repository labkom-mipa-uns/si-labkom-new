<?php

namespace App\Listeners;

use App\Alat;
use App\Events\EventPeminjamanAlatSaved;
use App\Transaksi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PeminjamanAlatSavedListener
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
     * @param EventPeminjamanAlatSaved $event
     * @return void
     */
    public function handle(EventPeminjamanAlatSaved $event): void
    {
        $peminjamanAlat = $event->peminjamanAlat;
        $transaksi = Transaksi::with(['peminjamanalat'])->firstWhere('id_alat', $peminjamanAlat->alat->id);
        Alat::whereId($peminjamanAlat->alat->id)->update([
            'stok_alat' => (int)$peminjamanAlat->alat->stok_alat - (int)$peminjamanAlat->jumlah_pinjam,
        ]);
        Transaksi::updateOrCreate([
            'id_alat' => $peminjamanAlat->alat->id
        ],[
            'id_peminjaman_alat' => $peminjamanAlat->id,
            'id_jasa_installasi' => null,
            'id_software' => null,
            'id_jasa_print' => null,
            'jenis_print' => null,
            'kategori' => 'peminjaman_alat',
            'harga' => $peminjamanAlat->alat->harga_alat,
            'jumlah' => (int)$peminjamanAlat->jumlah_pinjam + ((is_null($transaksi)) ? 0 : (int)$transaksi->jumlah),
            'total_bayar' => (int)$peminjamanAlat->jumlah_pinjam * (int)$peminjamanAlat->alat->harga_alat + ((is_null($transaksi)) ? 0 : (int)$transaksi->total_bayar),
            'tanggal' => $peminjamanAlat->tanggal_pinjam,
        ]);
    }
}
