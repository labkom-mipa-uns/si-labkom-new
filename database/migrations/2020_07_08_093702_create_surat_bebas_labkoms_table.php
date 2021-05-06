<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratBebasLabkomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_bebas_labkom', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mahasiswa');
            $table->date('tanggal');
            $table->enum('proses', ['0', '1', '2']);    // 0: Ditolak, 1: Dalam Proses/Menunggu Persetujuan, 2: Surat Sudah Siap/Disetujui, 3: Selesai
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('surat_bebas_labkom');
    }
}
