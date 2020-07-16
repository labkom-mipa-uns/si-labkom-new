<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Jadwal;
use App\Lab;
use App\Mahasiswa;
use App\PeminjamanLab;
use Faker\Generator as Faker;

$factory->define(PeminjamanLab::class, function (Faker $faker) {
    return [
        'id_mahasiswa' => factory(Mahasiswa::class),
        'id_lab' => factory(Lab::class),
        'id_jadwal' => factory(Jadwal::class),
        'tanggal' => $faker->dateTime,
        'jam_pinjam' => $faker->time(),
        'jam_kembali' => $faker->time(),
        'keperluan' => $faker->paragraph(5),
        'kategori' => $faker->randomElement(['didalam_jam','diluar_jam']),
        'status' => $faker->randomElement(['0','1']),
        'created_at' => now()
    ];
});
