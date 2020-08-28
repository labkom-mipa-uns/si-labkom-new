<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasaInstallasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_installasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mahasiswa');
            $table->string('laptop');
            $table->text('kelengkapan');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_software')->nullable();
            $table->enum('jenis', ['install', 'service']);
            $table->text('keterangan');
            $table->time('jam_ambil');
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa');
            $table->foreign('id_software')->references('id')->on('software');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jasa_installasi');
    }
}
