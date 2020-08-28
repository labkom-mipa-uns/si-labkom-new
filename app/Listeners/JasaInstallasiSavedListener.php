<?php

namespace App\Listeners;

use App\Events\EventJasaInstallasiSaved;
use App\Transaksi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class JasaInstallasiSavedListener
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
     * @param EventJasaInstallasiSaved $event
     * @return void
     */
    public function handle(EventJasaInstallasiSaved $event): void
    {
        $jasaInstallasi = $event->jasaInstallasi;
        $transaksi = Transaksi::with(['jasainstallasi'])
            ->where('id_software', $jasaInstallasi->software->id)
            ->where('tanggal', $jasaInstallasi->tanggal)->first();
        Transaksi::updateOrCreate([
            'id_software' => $jasaInstallasi->software->id,
            'tanggal' => $jasaInstallasi->tanggal,
        ],[
            'id_peminjaman_alat' => null,
            'id_jasa_installasi' => $jasaInstallasi->id,
            'id_alat' => null,
            'id_jasa_print' => null,
            'jenis_print' => null,
            'kategori' => 'jasa_installasi',
            'harga' => $jasaInstallasi->software->harga_software,
            'jumlah' => 1 + ((is_null($transaksi)) ? 0 : (int)$transaksi->jumlah),
            'total_bayar' => 1 * (int)$jasaInstallasi->software->harga_software + ((is_null($transaksi)) ? 0 : (int)$transaksi->total_bayar),
        ]);
    }
}
