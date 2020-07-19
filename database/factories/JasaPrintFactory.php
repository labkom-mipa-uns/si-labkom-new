<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JasaPrint;
use Faker\Generator as Faker;

$factory->define(JasaPrint::class, function (Faker $faker) {
    return [
        'jenis_print' => $faker->randomElement(['b&w','warna','warna-high']),
        'harga_print' => $faker->randomNumber(8),
        'tanggal_print' => $faker->date()
    ];
});
