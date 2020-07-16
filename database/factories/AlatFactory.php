<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Alat;
use Faker\Generator as Faker;

$factory->define(Alat::class, function (Faker $faker) {
    return [
        'nama_alat' => $faker->company,
        'harga_alat' => $faker->randomNumber()
    ];
});
