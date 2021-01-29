<?php

namespace App\Listeners;

use App\Models\Alat;
use App\Events\EventPeminjamanAlatUpdated;
use App\Models\Transaksi;

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
            return;
        }
        $transaksi = Transaksi::with(['peminjamanalat'])
            ->where('id_alat', $peminjamanAlat->alat->id)
            ->where('tanggal', $peminjamanAlat->tanggal_pinjam)
            ->first();
        Alat::where('id', $peminjamanAlat->alat->id)->update([
            'stok_alat' => (int) $peminjamanAlat->alat->stok_alat + (int) $transaksi->jumlah - (int) $peminjamanAlat->jumlah_pinjam,
        ]);
        $transaksi->update([
            'id_peminjaman_alat' => $peminjamanAlat->id,
            'harga' => $peminjamanAlat->alat->harga_alat,
            'jumlah' => (int) $peminjamanAlat->jumlah_pinjam,
            'total_bayar' => (int) $peminjamanAlat->jumlah_pinjam * (int) $peminjamanAlat->alat->harga_alat,
        ], [
            'id_alat' => $peminjamanAlat->alat->id,
            'tanggal' => $peminjamanAlat->tanggal_pinjam,
            'kategori' => 'peminjaman_alat'
        ]);
    }
}
