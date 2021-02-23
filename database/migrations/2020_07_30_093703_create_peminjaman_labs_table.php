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
            $table->unsignedBigInteger('id_dosen');
            $table->unsignedBigInteger('id_matkul');
            $table->date('tanggal');
            $table->time('jam_pinjam');
            $table->time('jam_kembali');
            $table->text('keperluan');
            $table->enum('kategori', ['didalam_jam', 'diluar_jam']);
            $table->enum('status', ['0', '1']);    // 0: Dipinjam, 1:  Dikembalikan
            $table->enum('proses', ['0', '1', '2']);    // 0: Ditolak, 1: Dalam Proses, 2: Diterima
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa');
            $table->foreign('id_lab')->references('id')->on('lab');
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
