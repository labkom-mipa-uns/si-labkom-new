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
            $table->date('tanggal');
            $table->string('laptop', 100);
            $table->string('kelengkapan', 255);
            $table->unsignedBigInteger('id_software');
            $table->timestamps();
            $table->enum('jenis', ['instal', 'service']);
            $table->time('jam_ambil');

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
        Schema::dropIfExists('jasa_installasis');
    }
}
