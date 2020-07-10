<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPeminjamanAlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_peminjaman_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjaman_alat');

            $table->integer('jumlah');
            $table->integer('total_bayar');
            $table->timestamps();

            $table->foreign('id_peminjaman_alat')->references('id')->on('peminjaman_alat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_peminjaman_alat');
    }
}
