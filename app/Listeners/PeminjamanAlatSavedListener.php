<?php

namespace App\Listeners;

use App\Models\Alat;
use App\Events\EventPeminjamanAlatSaved;
use App\Models\Transaksi;

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
        $transaksi = Transaksi::with(['peminjamanalat'])
            ->where('id_alat', $peminjamanAlat->alat->id)
            ->where('tanggal', $peminjamanAlat->tanggal_pinjam)->first();
        Alat::where('id', $peminjamanAlat->alat->id)->update([
            'stok_alat' => (int) $peminjamanAlat->alat->stok_alat - (int) $peminjamanAlat->jumlah_pinjam,
        ]);
        Transaksi::updateOrCreate([
            'id_alat' => $peminjamanAlat->alat->id,
            'tanggal' => $peminjamanAlat->tanggal_pinjam,
            'kategori' => 'peminjaman_alat',
        ],[
            'id_peminjaman_alat' => $peminjamanAlat->id,
            'harga' => $peminjamanAlat->alat->harga_alat,
            'jumlah' => (int) $peminjamanAlat->jumlah_pinjam + ((is_null($transaksi)) ? 0 : (int) $transaksi->jumlah),
            'total_bayar' => (int) $peminjamanAlat->jumlah_pinjam * (int) $peminjamanAlat->alat->harga_alat + ((is_null($transaksi)) ? 0 : (int) $transaksi->total_bayar),
        ]);
    }
}
