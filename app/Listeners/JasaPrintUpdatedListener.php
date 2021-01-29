<?php

namespace App\Listeners;

use App\Events\EventJasaPrintUpdated;
use App\Models\Transaksi;

class JasaPrintUpdatedListener
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
     * @param  EventJasaPrintUpdated  $event
     * @return void
     */
    public function handle(EventJasaPrintUpdated $event): void
    {
        $jasaPrint = $event->jasaPrint;
        $transaksi = Transaksi::with('jasaprint')
            ->where('id_jasa_print', $jasaPrint->id)
            ->first();
        $transaksi->update([
            'harga' => $jasaPrint->harga_print,
            'jumlah' => (int)$jasaPrint->jumlah_print,
            'total_bayar' => (int) $jasaPrint->jumlah_print * (int) $jasaPrint->harga_print,
        ],[
            'id_jasa_print' => $jasaPrint->id,
            'jenis_print' => $jasaPrint->jenis_print,
            'tanggal' => $jasaPrint->tanggal_print,
            'kategori' => 'jasa_print'
        ]);
    }
}
