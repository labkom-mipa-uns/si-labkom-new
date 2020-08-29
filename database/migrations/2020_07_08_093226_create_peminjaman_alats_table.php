<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanAlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_alat');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->time('jam_pinjam');
            $table->time('jam_kembali');
            $table->integer('jumlah_pinjam');
            $table->text('keperluan');
            $table->enum('status', ['0', '1']);
            $table->timestamps();

            $table->foreign('id_alat')->references('id')->on('alat');
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_alat');
    }
}
