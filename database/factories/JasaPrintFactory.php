<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JasaPrint;
use Faker\Generator as Faker;

$factory->define(JasaPrint::class, function (Faker $faker) {
    return [
        'jenis_print' => $faker->randomElement(['Hitam Putih', 'Warna', 'Warna-full']),
        'harga_print' => $faker->randomNumber(8),
        'jumlah_print' => $faker->randomNumber(2),
        'tanggal_print' => $faker->date()
    ];
});
