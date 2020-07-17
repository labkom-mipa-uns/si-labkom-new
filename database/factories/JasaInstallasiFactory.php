<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JasaInstallasi;
use App\Mahasiswa;
use App\Software;
use Faker\Generator as Faker;

$factory->define(JasaInstallasi::class, function (Faker $faker) {
    return [
        'id_mahasiswa' => factory(Mahasiswa::class),
        'laptop' => $faker->century,
        'kelengkapan' => $faker->text(40),
        'tanggal' => $faker->date(),
        'id_software' => factory(Software::class),
        'jenis' => $faker->randomElement(['install', 'service']),
        'keterangan' => $faker->paragraph(10),
        'jam_ambil' => $faker->time()
    ];
});
