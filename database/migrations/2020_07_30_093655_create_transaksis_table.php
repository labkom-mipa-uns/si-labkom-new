<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peminjaman_alat');
            $table->unsignedBigInteger('id_jasa_print');
            $table->unsignedBigInteger('id_jasa_installasi');

            $table->integer('jumlah');
            $table->integer('total_bayar');
            $table->timestamps();

            $table->foreign('id_peminjaman_alat')->references('id')->on('peminjaman_alat');
            $table->foreign('id_jasa_print')->references('id')->on('jasa_print');
            $table->foreign('id_jasa_installasi')->references('id')->on('jasa_installasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
