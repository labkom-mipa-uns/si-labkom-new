<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Alat;
use App\Mahasiswa;
use App\PeminjamanAlat;
use Faker\Generator as Faker;

$factory->define(PeminjamanAlat::class, function (Faker $faker) {
    return [
        'id_mahasiswa' => factory(Mahasiswa::class),
        'tanggal_pinjam' => $faker->dateTime,
        'tanggal_kembali' => $faker->dateTime,
        'id_alat' => factory(Alat::class),
        'keperluan' => $faker->paragraph(5),
        'status' => $faker->randomElement(['0','1'])
    ];
});
