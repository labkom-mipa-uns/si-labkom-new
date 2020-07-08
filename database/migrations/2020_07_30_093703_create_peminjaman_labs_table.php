<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_lab', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_lab');
            $table->unsignedBigInteger('id_jadwal');
            $table->date('tanggal');
            $table->time('jam_pinjam');
            $table->time('jam_kembali');
            $table->text('keperluan');
            $table->enum('kategori', ['didalam_jam', 'diluar_jam']);
            $table->enum('status', ['0', '1']);
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa');
            $table->foreign('id_lab')->references('id')->on('lab');
            $table->foreign('id_jadwal')->references('id')->on('jadwal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_lab');
    }
}
