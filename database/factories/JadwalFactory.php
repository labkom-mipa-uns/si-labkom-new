<?php
namespace Database\Factories;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jadwal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {

        return [
            'id_dosen' => Dosen::factory()->count(1)->create(),
            'id_matkul' => MataKuliah::factory()->count(1)->create(),
            'id_prodi' => Prodi::factory()->count(1)->create(),
        ];
    }
}
