<?php

/** @var Factory $factory */

use App\Alat;
use App\Mahasiswa;
use App\PeminjamanAlat;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(PeminjamanAlat::class, function (Faker $faker) {
    return [
        'id_mahasiswa' => factory(Mahasiswa::class),
        'tanggal_pinjam' => $faker->dateTime,
        'tanggal_kembali' => $faker->dateTime,
        'jam_pinjam' => $faker->time(),
        'jam_kembali' => $faker->time(),
        'jumlah_pinjam' => $faker->randomNumber(1),
        'id_alat' => factory(Alat::class),
        'keperluan' => $faker->paragraph(5),
        'status' => $faker->randomElement(['0','1'])
    ];
});
