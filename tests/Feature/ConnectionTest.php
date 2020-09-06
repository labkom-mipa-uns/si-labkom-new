<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ConnectionTest extends TestCase
{
    public $user;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testWelcome(): void
    {
        $response = $this->get(route('welcome'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testLogin(): void
    {
        $response = $this->get('/login');
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testRegister(): void
    {
        $response = $this->get('/register');
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testHome(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('home'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testPeminjamanAlat(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->get(route('PeminjamanAlat.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testPeminjamanLab(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('PeminjamanLab.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testJasaInstallasi(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('JasaInstallasi.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testJasaPrint(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('JasaPrint.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testSuratBebasLabkom(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('SuratBebasLabkom.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testAlat(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('Alat.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testDosen(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('Dosen.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testJadwal(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('Jadwal.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testLab(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('Laboratorium.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testMataKuliah(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('MataKuliah.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testProdi(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('Prodi.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testSoftware(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('Software.index'));
        $response->assertOk();
    }

    /**
     * @return void
     */
    public function testUser(): void
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)->get(route('User.index'));
        $response->assertOk();
    }
}
