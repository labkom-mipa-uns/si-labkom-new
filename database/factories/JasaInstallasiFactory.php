<?php
namespace Database\Factories;

use App\JasaInstallasi;
use App\Mahasiswa;
use App\Software;
use Illuminate\Database\Eloquent\Factories\Factory;

class JasaInstallasiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JasaInstallasi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id_mahasiswa' => Mahasiswa::factory()->count(1)->create(),
            'laptop' => $this->faker->century,
            'kelengkapan' => $this->faker->text(40),
            'tanggal' => $this->faker->date(),
            'id_software' => Software::factory()->count()->create(),
            'jenis' => $this->faker->randomElement(['install', 'service']),
            'keterangan' => $this->faker->paragraph(10),
            'jam_ambil' => $this->faker->time()
        ];
    }
}
