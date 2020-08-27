<?php

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

Route::get('/', 'WelcomeController')->name('welcome');

Auth::routes(['verify' => true]);
Route::get('/home', 'Home\HomeController')->name('home');
Route::resource('Account', 'Account\AccountController');
Route::resource('PeminjamanLab', 'PeminjamanLab\PeminjamanLabController');
Route::resource('PeminjamanAlat', 'PeminjamanAlat\PeminjamanAlatController');
Route::post('/PeminjamanAlat/DailyReport', 'PeminjamanAlat\PeminjamanAlatController@daily_report')->name('PeminjamanAlat.daily_report');
Route::post('/PeminjamanAlat/MonthlyReport', 'PeminjamanAlat\PeminjamanAlatController@monthly_report')->name('PeminjamanAlat.monthly_report');
Route::resource('SuratBebasLabkom', 'SuratBebasLabkom\SuratBebasLabkomController');
Route::resource('JasaInstallasi', 'JasaInstallasi\JasaInstallasiController');
Route::resource('JasaPrint', 'JasaPrint\JasaPrintController');
Route::resource('Laboratorium', 'Lab\LabController');
Route::resource('Alat', 'Alat\AlatController');
Route::resource('Mahasiswa', 'Mahasiswa\MahasiswaController');
Route::resource('Prodi', 'Prodi\ProdiController');
Route::resource('Dosen', 'Dosen\DosenController');
Route::resource('MataKuliah', 'MataKuliah\MataKuliahController');
Route::resource('Jadwal', 'Jadwal\JadwalController');
Route::resource('Software', 'Software\SoftwareController');
Route::resource('User', 'User\UserController');
