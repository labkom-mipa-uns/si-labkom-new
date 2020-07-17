<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->char('nim', 8);
            $table->string('nama_mahasiswa', 60);
            $table->enum('jenis_kelamin', ['L','P']);
            $table->string('kelas', 5);
            $table->unsignedBigInteger('id_prodi');
            $table->enum('angkatan', ['2016', '2017','2018','2019','2020']);
            $table->string('no_hp');
            $table->timestamps();

            $table->foreign('id_prodi')->references('id')->on('prodi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
