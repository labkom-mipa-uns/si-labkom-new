<?php

use App\Http\Controllers\Api\V1\Account\AccountController;
use App\Http\Controllers\Api\V1\Alat\AlatController;
use App\Http\Controllers\Api\V1\Dosen\DosenController;
use App\Http\Controllers\Api\V1\Jadwal\JadwalController;
use App\Http\Controllers\Api\V1\JasaInstallasi\JasaInstallasiController;
use App\Http\Controllers\Api\V1\JasaPrint\JasaPrintController;
use App\Http\Controllers\Api\V1\Lab\LabController;
use App\Http\Controllers\Api\V1\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Api\V1\MataKuliah\MataKuliahController;
use App\Http\Controllers\Api\V1\PeminjamanAlat\PeminjamanAlatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->as('api.')->group(static function () {
    Route::apiResource('Account', AccountController::class);
    Route::apiResource('Alat', AlatController::class);
    Route::apiResource('Dosen', DosenController::class);
    Route::apiResource('Jadwal', JadwalController::class);
    Route::apiResource('JasaInstallasi', JasaInstallasiController::class);
    Route::apiResource('JasaPrint', JasaPrintController::class);
    Route::apiResource('Lab', LabController::class);
    Route::apiResource('Mahasiswa', MahasiswaController::class);
    Route::apiResource('MataKuliah', MataKuliahController::class);
    Route::apiResource('PeminjamanAlat', PeminjamanAlatController::class);
});
