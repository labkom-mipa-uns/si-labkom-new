<?php
namespace Database\Factories;

use App\Jadwal;
use App\Lab;
use App\Mahasiswa;
use App\PeminjamanLab;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeminjamanLabFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PeminjamanLab::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id_mahasiswa' => Mahasiswa::factory()->count(1)->create(),
            'id_lab' => Lab::factory()->count(1)->create(),
            'id_jadwal' => Jadwal::factory()->count()->create(),
            'tanggal' => $this->faker->dateTime,
            'jam_pinjam' => $this->faker->time(),
            'jam_kembali' => $this->faker->time(),
            'keperluan' => $this->faker->paragraph(5),
            'kategori' => $this->faker->randomElement(['didalam_jam','diluar_jam']),
            'status' => $this->faker->randomElement(['0','1']),
            'created_at' => now()
        ];
    }
}
