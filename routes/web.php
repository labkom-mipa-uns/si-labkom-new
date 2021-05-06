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
use App\Http\Controllers\User\Contact\ContactController;
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

# ==== Contact Mail ====
Route::post('/Contact', [ContactController::class, 'store'])->name('Contact.store');

# ==== User ====
// Peminjaman Lab
Route::resource('PeminjamanLab', UserPeminjamanLabController::class)->names('UserPeminjamanLab')->except(['show', 'edit', 'update', 'destroy']);
Route::get('/PeminjamanLab/exportWord/{PeminjamanLab}', [UserPeminjamanLabController::class, 'exportToWord'])->name('UserPeminjamanLab.exportToWord');

// Peminjaman Alat
Route::resource('PeminjamanAlat', UserPeminjamanAlatController::class)->names('UserPeminjamanAlat')->except(['show', 'edit', 'update', 'destroy']);
Route::get('/PeminjamanAlat/exportWord/{PeminjamanAlat}', [UserPeminjamanAlatController::class, 'exportToWord'])->name('UserPeminjamanAlat.exportToWord');

// Surat Bebas Labkom
Route::resource('SuratBebasLabkom', UserSuratBebasLabkomController::class)->names('UserSuratBebasLabkom')->except(['show', 'edit', 'update', 'destroy']);
Route::get('/SuratBebasLabkom/exportWord/{SuratBebasLabkom}', [UserSuratBebasLabkomController::class, 'exportToWord'])->name('UserSuratBebasLabkom.exportToWord');

# ==== Admin ====
/*
    Route yang mungkin sering kita gunakan PeminjamanLab, PeminjamanAlat, SuratBebasLabkom
    Laboratorium, Alat, Mahasiswa, Dosen, dan Mata Kuliah. Lalu HTTP Method PUT dan
    DELETE belum berfungsi server CWP nya, jadi untuk update dan destroy sementara saya
    ganti menjadi POST dan GET di 8 routes diatas. Mungkin kedepannyabisa diubah ke
    PUT dan DELETE lagi jika konfigurasi web server nya sudah ditambahkan HTTP method
    PUT dan DELETE.
*/

// Redirect url '/admin'
Route::redirect('admin', '/admin/Dashboard');

// Auth
Auth::routes(['verify' => false]);

// Url Prefix 'admin/'
Route::prefix('admin')->middleware(['verified'])->group(static function () {

    // Dashboard
    Route::get('Dashboard', DashboardController::class)->name('Dashboard');

    // Peminjaman Lab
    Route::resource('PeminjamanLab', PeminjamanLabController::class)->except([
        'update', 'destroy'
    ]);

    Route::post('PeminjamanLab/{PeminjamanLab}/update', [PeminjamanLabController::class, 'update'])->name('PeminjamanLab.update');
    Route::get('PeminjamanLab/{PeminjamanLab}/destroy', [PeminjamanLabController::class, 'destroy'])->name('PeminjamanLab.destroy');

    // Peminjaman Alat
    Route::resource('PeminjamanAlat', PeminjamanAlatController::class)->except([
        'update', 'destroy'
    ]);
    Route::post('PeminjamanAlat/{PeminjamanAlat}/update', [PeminjamanAlatController::class, 'update'])->name('PeminjamanAlat.update');
    Route::get('PeminjamanAlat/{PeminjamanAlat}/destroy', [PeminjamanAlatController::class, 'destroy'])->name('PeminjamanAlat.destroy');

    // Route::post('PeminjamanAlat/DailyReport', [PeminjamanAlatController::class,'daily_report'])->name('PeminjamanAlat.daily_report');
    // Route::post('PeminjamanAlat/MonthlyReport', [PeminjamanAlatController::class, 'monthly_report'])->name('PeminjamanAlat.monthly_report');
    // Surat Bebas Labkom
    Route::resource('SuratBebasLabkom', SuratBebasLabkomController::class)->except([
        'update', 'destroy'
    ]);

    Route::post('SuratBebasLabkom/{SuratBebasLabkom}/update', [SuratBebasLabkomController::class, 'update'])->name('SuratBebasLabkom.update');
    Route::get('SuratBebasLabkom/{SuratBebasLabkom}/destroy', [SuratBebasLabkomController::class, 'destroy'])->name('SuratBebasLabkom.destroy');

    ####################################################################################
    ####################################################################################
    ####################################################################################

    // Jasa Installasi
    Route::resource('JasaInstallasi', JasaInstallasiController::class)->except(['update', 'destroy']);

    Route::post('JasaInstallasi/{JasaInstallasi}/update', [JasaInstallasiController::class, 'update'])->name('JasaInstallasi.update');
    Route::get('JasaInstallasi/{JasaInstallasi}/destroy', [JasaInstallasiController::class, 'destroy'])->name('JasaInstallasi.destroy');
    // Route::post('JasaInstallasi/DailyReport', [JasaInstallasiController::class,'daily_report'])->name('JasaInstallasi.daily_report');
    // Route::post('JasaInstallasi/MonthlyReport', [JasaInstallasiController::class, 'monthly_report'])->name('JasaInstallasi.monthly_report');

    // Jasa Print
    Route::resource('JasaPrint', JasaPrintController::class)->except(['update', 'destroy']);

    Route::post('JasaPrint/{JasaPrint}/update', [SuratBebasLabkomController::class, 'update'])->name('JasaPrint.update');
    Route::get('JasaPrint/{JasaPrint}/destroy', [SuratBebasLabkomController::class, 'destroy'])->name('JasaPrint.destroy');
    // Route::post('JasaPrint/DailyReport', [JasaPrintController::class, 'daily_report'])->name('JasaPrint.daily_report');
    // Route::post('JasaPrint/MonthlyReport', [JasaPrintController::class, 'monthly_report'])->name('JasaPrint.monthly_report');

    // Laboratorium
    Route::resource('Laboratorium', LabController::class)->except(['update', 'destroy']);
    Route::post('Laboratorium/{Laboratorium}/update', [LabController::class, 'update'])->name('Laboratorium.update');
    Route::get('Laboratorium/{Laboratorium}/destroy', [LabController::class, 'destroy'])->name('Laboratorium.destroy');

    // Alat
    Route::resource('Alat', AlatController::class)->except(['update', 'destroy']);
    Route::post('Alat/{Alat}/update', [AlatController::class, 'update'])->name('Alat.update');
    Route::get('Alat/{Alat}/destroy', [AlatController::class, 'destroy'])->name('Alat.destroy');

    // Mahasiswa
    Route::resource('Mahasiswa', MahasiswaController::class)->except(['update', 'destroy']);
    Route::post('Mahasiswa/{Mahasiswa}/update', [MahasiswaController::class, 'update'])->name('Mahasiswa.update');
    Route::get('Mahasiswa/{Mahasiswa}/destroy', [MahasiswaController::class, 'destroy'])->name('Mahasiswa.destroy');

    // Program Studi
    Route::resource('Prodi', ProdiController::class)->except(['update', 'destroy']);
    Route::post('Prodi/{Prodi}/update', [ProdiController::class, 'update'])->name('Prodi.update');
    Route::get('Prodi/{Prodi}/destroy', [ProdiController::class, 'destroy'])->name('Prodi.destroy');

    // Dosen
    Route::resource('Dosen', DosenController::class)->except(['update', 'destroy']);
    Route::post('Dosen/{Dosen}/update', [DosenController::class, 'update'])->name('Dosen.update');
    Route::get('Dosen/{Dosen}/destroy', [DosenController::class, 'destroy'])->name('Dosen.destroy');

    // Mata Kuliah
    Route::resource('MataKuliah', MataKuliahController::class)->except(['update', 'destroy']);
    Route::post('MataKuliah/{MataKuliah}/update', [MataKuliahController::class, 'update'])->name('MataKuliah.update');
    Route::get('MataKuliah/{MataKuliah}/destroy', [MataKuliahController::class, 'destroy'])->name('MataKuliah.destroy');

    // Software
    Route::resource('Software', SoftwareController::class)->except(['update', 'destroy']);
    Route::post('Software/{Software}/update', [SoftwareController::class, 'update'])->name('Software.update');
    Route::get('Software/{Software}/destroy', [SoftwareController::class, 'destroy'])->name('Software.destroy');

    // User
    Route::resource('User', UserController::class)->except(['update', 'destroy']);
    Route::post('User/{User}/update', [UserController::class, 'update'])->name('User.update');
    Route::get('User/{User}/destroy', [UserController::class, 'destroy'])->name('User.destroy');
});
