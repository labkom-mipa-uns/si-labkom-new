<?php

use App\Http\Controllers\Admin\Account\AccountController;
use App\Http\Controllers\Admin\Alat\AlatController;
use App\Http\Controllers\Admin\Dosen\DosenController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Jadwal\JadwalController;
use App\Http\Controllers\Admin\JasaInstallasi\JasaInstallasiController;
use App\Http\Controllers\Admin\JasaPrint\JasaPrintController;
use App\Http\Controllers\Admin\Lab\LabController;
use App\Http\Controllers\Admin\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Admin\MataKuliah\MataKuliahController;
use App\Http\Controllers\Admin\PeminjamanLab\PeminjamanLabController;
use App\Http\Controllers\Admin\Prodi\ProdiController;
use App\Http\Controllers\Admin\Software\SoftwareController;
use App\Http\Controllers\Admin\SuratBebasLabkom\SuratBebasLabkomController;
use App\Http\Controllers\Admin\PeminjamanAlat\PeminjamanAlatController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');
Route::redirect('admin', '/admin/Dashboard');
Auth::routes(['verify' => true]);
Route::prefix('admin')->middleware(['verified'])->group(static function () {
    Route::get('Dashboard', DashboardController::class)->name('Dashboard');
    Route::resource('Account', AccountController::class);
    Route::resource('PeminjamanLab', PeminjamanLabController::class);
    Route::resource('PeminjamanAlat', PeminjamanAlatController::class);
    Route::post('PeminjamanAlat/DailyReport', [PeminjamanAlatController::class,'daily_report'])->name('PeminjamanAlat.daily_report');
    Route::post('PeminjamanAlat/MonthlyReport', [PeminjamanAlatController::class, 'monthly_report'])->name('PeminjamanAlat.monthly_report');
    Route::resource('SuratBebasLabkom', SuratBebasLabkomController::class);
    Route::resource('JasaInstallasi', JasaInstallasiController::class);
    Route::post('JasaInstallasi/DailyReport', [JasaInstallasiController::class,'daily_report'])->name('JasaInstallasi.daily_report');
    Route::post('JasaInstallasi/MonthlyReport', [JasaInstallasiController::class, 'monthly_report'])->name('JasaInstallasi.monthly_report');
    Route::resource('JasaPrint', JasaPrintController::class);
    Route::post('JasaPrint/DailyReport', [JasaPrintController::class, 'daily_report'])->name('JasaPrint.daily_report');
    Route::post('JasaPrint/MonthlyReport', [JasaPrintController::class, 'monthly_report'])->name('JasaPrint.monthly_report');
    Route::resource('Laboratorium', LabController::class);
    Route::resource('Alat', AlatController::class);
    Route::resource('Mahasiswa', MahasiswaController::class);
    Route::resource('Prodi', ProdiController::class);
    Route::resource('Dosen', DosenController::class);
    Route::resource('MataKuliah', MataKuliahController::class);
    Route::resource('Jadwal', JadwalController::class);
    Route::resource('Software', SoftwareController::class);
    Route::resource('User', UserController::class);
});
