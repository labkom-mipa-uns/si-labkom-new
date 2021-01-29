<?php

namespace App\Listeners;

use App\Events\EventJasaPrintSaved;
use App\Models\Transaksi;

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
        Transaksi::create([
            'jenis_print' => $jasaPrint->jenis_print,
            'tanggal' => $jasaPrint->tanggal_print,
            'id_jasa_print' => $jasaPrint->id,
            'kategori' => 'jasa_print',
            'harga' => $jasaPrint->harga_print,
            'jumlah' => (int) $jasaPrint->jumlah_print,
            'total_bayar' => (int) $jasaPrint->jumlah_print * (int) $jasaPrint->harga_print,
        ]);
    }
}
