<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiJasaInstallasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_jasa_installasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jasa_installasi');

            $table->integer('jumlah');
            $table->integer('total_bayar');
            $table->timestamps();

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
        Schema::dropIfExists('transaksi_jasa_installasi');
    }
}
