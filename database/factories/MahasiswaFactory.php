<?php
namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mahasiswa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'nim' => $this->faker->randomNumber(8),
            'nama_mahasiswa' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['L','P']),
            'kelas' => $this->faker->randomElement(['TIA','TIB','TID']),
            'id_prodi' => Prodi::factory()->count(1)->create(),
            'angkatan' => $this->faker->randomElement(['2016','2017','2018','2019','2020']),
            'no_hp' => $this->faker->phoneNumber,
            'created_at' => now()
        ];
    }
}
