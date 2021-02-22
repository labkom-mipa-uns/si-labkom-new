<?php

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
use App\Http\Controllers\User\Home\HomeController;
use App\Http\Controllers\User\PeminjamanLab\PeminjamanLabController as UserPeminjamanLabController;
use App\Http\Controllers\User\PeminjamanAlat\PeminjamanAlatController as UserPeminjamanAlatController;
use App\Http\Controllers\User\SuratBebasLabkom\SuratBebasLabkomController as UserSuratBebasLabkomController;
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

# ==== User ====
// Peminjaman Lab
Route::get('/PeminjamanLab', [UserPeminjamanLabController::class, 'index'])->name('UserPeminjamanLab.index');
Route::get('/PeminjamanLab/create', [UserPeminjamanLabController::class, 'create'])->name('UserPeminjamanLab.create');
Route::post('/PeminjamanLab', [UserPeminjamanLabController::class, 'store'])->name('UserPeminjamanLab.store');
Route::get('/PeminjamanLab/{PeminjamanLab}', [UserPeminjamanLabController::class, 'show'])->name('UserPeminjamanLab.show');
Route::get('/PeminjamanLab/{PeminjamanLab}/edit', [UserPeminjamanLabController::class, 'edit'])->name('UserPeminjamanLab.edit');
Route::put('/PeminjamanLab/{PeminjamanLab}', [UserPeminjamanLabController::class, 'update'])->name('UserPeminjamanLab.update');
Route::delete('/PeminjamanLab/{PeminjamanLab}', [UserPeminjamanLabController::class, 'destroy'])->name('UserPeminjamanLab.destroy');
Route::get('/PeminjamanLab/exportWord/{PeminjamanLab}', [UserPeminjamanLabController::class, 'exportToWord'])->name('UserPeminjamanLab.exportToWord');
// Peminjaman Alat
Route::get('/PeminjamanAlat', [UserPeminjamanAlatController::class, 'index'])->name('UserPeminjamanAlat.index');
Route::get('/PeminjamanAlat/create', [UserPeminjamanAlatController::class, 'create'])->name('UserPeminjamanAlat.create');
Route::post('/PeminjamanAlat', [UserPeminjamanAlatController::class, 'store'])->name('UserPeminjamanAlat.store');
Route::get('/PeminjamanAlat/{PeminjamanAlat}', [UserPeminjamanAlatController::class, 'show'])->name('UserPeminjamanAlat.show');
Route::get('/PeminjamanAlat/{PeminjamanAlat}/edit', [UserPeminjamanAlatController::class, 'edit'])->name('UserPeminjamanAlat.edit');
Route::put('/PeminjamanAlat/{PeminjamanAlat}', [UserPeminjamanAlatController::class, 'update'])->name('UserPeminjamanAlat.update');
Route::delete('/PeminjamanAlat/{PeminjamanAlat}', [UserPeminjamanAlatController::class, 'destroy'])->name('UserPeminjamanAlat.destroy');
Route::get('/PeminjamanAlat/exportWord/{PeminjamanAlat}', [UserPeminjamanAlatController::class, 'exportToWord'])->name('UserPeminjamanAlat.exportToWord');
// Surat Bebas Labkom
Route::get('/SuratBebasLabkom', [UserSuratBebasLabkomController::class, 'index'])->name('UserSuratBebasLabkom.index');
Route::get('/SuratBebasLabkom/create', [UserSuratBebasLabkomController::class, 'create'])->name('UserSuratBebasLabkom.create');
Route::post('/SuratBebasLabkom', [UserSuratBebasLabkomController::class, 'store'])->name('UserSuratBebasLabkom.store');
Route::get('/SuratBebasLabkom/{SuratBebasLabkom}', [UserSuratBebasLabkomController::class, 'show'])->name('UserSuratBebasLabkom.show');
Route::get('/SuratBebasLabkom/{SuratBebasLabkom}/edit', [UserSuratBebasLabkomController::class, 'edit'])->name('UserSuratBebasLabkom.edit');
Route::put('/SuratBebasLabkom/{SuratBebasLabkom}', [UserSuratBebasLabkomController::class, 'update'])->name('UserSuratBebasLabkom.update');
Route::delete('/SuratBebasLabkom/{SuratBebasLabkom}', [UserSuratBebasLabkomController::class, 'destroy'])->name('UserSuratBebasLabkom.destroy');

# ==== Admin ====
// Redirect url '/admin'
Route::redirect('admin', '/admin/Dashboard');
// Auth
Auth::routes(['verify' => false]);
// Url Prefix 'admin/'
Route::prefix('admin')->middleware(['auth'])->group(static function () {
    // Dashboard
    Route::get('Dashboard', DashboardController::class)->name('Dashboard');
    // Peminjaman Lab
    Route::resource('PeminjamanLab', PeminjamanLabController::class);
    // Peminjaman Alat
    Route::resource('PeminjamanAlat', PeminjamanAlatController::class);
    Route::post('PeminjamanAlat/DailyReport', [PeminjamanAlatController::class,'daily_report'])->name('PeminjamanAlat.daily_report');
    Route::post('PeminjamanAlat/MonthlyReport', [PeminjamanAlatController::class, 'monthly_report'])->name('PeminjamanAlat.monthly_report');
    // Surat Bebas Labkom
    Route::resource('SuratBebasLabkom', SuratBebasLabkomController::class);
    // Jasa Installasi
    Route::resource('JasaInstallasi', JasaInstallasiController::class);
    Route::post('JasaInstallasi/DailyReport', [JasaInstallasiController::class,'daily_report'])->name('JasaInstallasi.daily_report');
    Route::post('JasaInstallasi/MonthlyReport', [JasaInstallasiController::class, 'monthly_report'])->name('JasaInstallasi.monthly_report');
    // Jasa Print
    Route::resource('JasaPrint', JasaPrintController::class);
    Route::post('JasaPrint/DailyReport', [JasaPrintController::class, 'daily_report'])->name('JasaPrint.daily_report');
    Route::post('JasaPrint/MonthlyReport', [JasaPrintController::class, 'monthly_report'])->name('JasaPrint.monthly_report');
    // Laboratorium
    Route::resource('Laboratorium', LabController::class);
    // Alat
    Route::resource('Alat', AlatController::class);
    // Mahasiswa
    Route::resource('Mahasiswa', MahasiswaController::class);
    // Program Studi
    Route::resource('Prodi', ProdiController::class);
    // Dosen
    Route::resource('Dosen', DosenController::class);
    // Mata Kuliah
    Route::resource('MataKuliah', MataKuliahController::class);
    // Jadwal
    Route::resource('Jadwal', JadwalController::class);
    // Software
    Route::resource('Software', SoftwareController::class);
    // User
    Route::resource('User', UserController::class);
});
