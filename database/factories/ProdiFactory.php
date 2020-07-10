<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Prodi;
use Faker\Generator as Faker;

$factory->define(Prodi::class, function (Faker $faker) {
    return [
        'nama_prodi' => $faker->jobTitle,
        'created_at' => now(),
    ];
});
