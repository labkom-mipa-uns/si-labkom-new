<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mahasiswa;
use App\SuratBebasLabkom;
use Faker\Generator as Faker;

$factory->define(SuratBebasLabkom::class, function (Faker $faker) {
    return [
        'id_mahasiswa' => factory(Mahasiswa::class),
        'tanggal' => $faker->date(),
        'keperluan' => $faker->paragraph(5)
    ];
});
