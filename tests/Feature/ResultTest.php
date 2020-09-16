<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResultTest extends TestCase
{
    public $user;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAccount(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('Account.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testAlat(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('Alat.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testDosen(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('Dosen.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testJadwal(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('Jadwal.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testJasaInstallasi(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('JasaInstallasi.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testJasaPrint(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('JasaPrint.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testLab(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('Laboratorium.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testMahasiswa(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('Mahasiswa.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testMataKuliah(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('MataKuliah.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testPeminjamanAlat(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('PeminjamanAlat.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testPeminjamanLab(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('PeminjamanLab.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testProdi(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('Prodi.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testSoftware(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('Software.all'));
        $response->assertSuccessful();
    }

    /**
     * @return void
     */
    public function testSuratBebasLabkom(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('SuratBebasLabkom.all'));
        $response->assertSuccessful();
    }
}
