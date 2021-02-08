<?php
namespace Database\Factories;

use App\Models\Alat;
use App\Models\Mahasiswa;
use App\Models\PeminjamanAlat;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeminjamanAlatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PeminjamanAlat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id_mahasiswa' => Mahasiswa::factory()->count(1)->create(),
            'tanggal_pinjam' => $this->faker->dateTime,
            'tanggal_kembali' => $this->faker->dateTime,
            'jam_pinjam' => $this->faker->time(),
            'jam_kembali' => $this->faker->time(),
            'jumlah_pinjam' => $this->faker->randomNumber(1),
            'id_alat' => Alat::factory()->count(1)->create(),
            'keperluan' => $this->faker->paragraph(5),
            'status' => $this->faker->randomElement(['0','1'])
        ];
    }
}
