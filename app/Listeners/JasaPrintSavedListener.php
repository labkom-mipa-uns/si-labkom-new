<?php

namespace App\Listeners;

use App\Events\EventJasaPrintSaved;
use App\Transaksi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class JasaPrintSavedListener
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
     * @param EventJasaPrintSaved $event
     * @return void
     */
    public function handle(EventJasaPrintSaved $event): void
    {
        $jasaPrint = $event->jasaPrint;
        $transaksi = Transaksi::with(['jasaprint'])
            ->where('jenis_print', $jasaPrint->jenis_print)
            ->where('tanggal', $jasaPrint->tanggal_print)->first();
        Transaksi::updateOrCreate([
            'jenis_print' => $jasaPrint->jenis_print,
            'tanggal' => $jasaPrint->tanggal_print,
        ],[
            'id_peminjaman_alat' => null,
            'id_jasa_print' => $jasaPrint->id,
            'id_jasa_installasi' => null,
            'id_alat' => null,
            'id_software' => null,
            'kategori' => 'jasa_print',
            'harga' => $jasaPrint->harga_print,
            'jumlah' => (int)$jasaPrint->jumlah_print + ((is_null($transaksi)) ? 0 : (int)$transaksi->jumlah),
            'total_bayar' => (int)$jasaPrint->jumlah_print * (int)$jasaPrint->harga_print + ((is_null($transaksi)) ? 0 : (int)$transaksi->total_bayar),
        ]);
    }
}
