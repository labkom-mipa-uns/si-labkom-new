<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiJasaPrintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_jasa_print', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jasa_print');

            $table->integer('jumlah');
            $table->integer('total_bayar');
            $table->timestamps();

            $table->foreign('id_jasa_print')->references('id')->on('jasa_print');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_jasa_prints');
    }
}
