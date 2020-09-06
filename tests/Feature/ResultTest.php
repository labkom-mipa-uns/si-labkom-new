<?php

namespace Tests\Feature;

use App\Http\Resources\PeminjamanAlatResource;
use App\PeminjamanAlat;
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

    public function testJadwal()
    {
        $this->user = User::firstWhere('role', 'super admin');
        $response = $this->actingAs($this->user)
            ->getJson(route('Jadwal.all'));
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

}
