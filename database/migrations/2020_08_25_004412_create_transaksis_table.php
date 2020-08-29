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
            $table->unsignedBigInteger('id_peminjaman_alat')->nullable();
            $table->unsignedBigInteger('id_alat')->nullable();
            $table->unsignedBigInteger('id_jasa_installasi')->nullable();
            $table->unsignedBigInteger('id_software')->nullable();
            $table->unsignedBigInteger('id_jasa_print')->nullable();
            $table->enum('jenis_print', ['Hitam Putih', 'Warna', 'Warna-full'])->nullable();
            $table->enum('kategori', ['peminjaman_alat', 'jasa_installasi', 'jasa_print']);
            $table->integer('harga');
            $table->integer('jumlah');
            $table->unsignedBigInteger('total_bayar');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_peminjaman_alat')->references('id')->on('peminjaman_alat');
            $table->foreign('id_alat')->references('id')->on('alat');
            $table->foreign('id_jasa_installasi')->references('id')->on('jasa_installasi');
            $table->foreign('id_software')->references('id')->on('software');
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
        Schema::dropIfExists('transaksi');
    }
}
