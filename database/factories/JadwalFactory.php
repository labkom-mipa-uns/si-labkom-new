<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dosen;
use App\Jadwal;
use App\MataKuliah;
use App\Prodi;
use Faker\Generator as Faker;

$factory->define(Jadwal::class, function () {
    return [
        'id_dosen' => factory(Dosen::class),
        'id_matkul' => factory(MataKuliah::class),
        'id_prodi' => factory(Prodi::class),
    ];
});
