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
Route::get('/Account/all', 'Account\AccountController@all')->name('Account.all');
Route::resource('Account', 'Account\AccountController');
Route::get('/PeminjamanLab/all', 'PeminjamanLab\PeminjamanLabController@all')->name('PeminjamanLab.all');
Route::resource('PeminjamanLab', 'PeminjamanLab\PeminjamanLabController');
Route::get('/PeminjamanAlat/all', 'PeminjamanAlat\PeminjamanAlatController@all')->name('PeminjamanAlat.all');
Route::resource('PeminjamanAlat', 'PeminjamanAlat\PeminjamanAlatController');
Route::post('/PeminjamanAlat/DailyReport', 'PeminjamanAlat\PeminjamanAlatController@daily_report')->name('PeminjamanAlat.daily_report');
Route::post('/PeminjamanAlat/MonthlyReport', 'PeminjamanAlat\PeminjamanAlatController@monthly_report')->name('PeminjamanAlat.monthly_report');
Route::resource('SuratBebasLabkom', 'SuratBebasLabkom\SuratBebasLabkomController');
Route::resource('JasaInstallasi', 'JasaInstallasi\JasaInstallasiController');
Route::post('/JasaInstallasi/DailyReport', 'JasaInstallasi\JasaInstallasiController@daily_report')->name('JasaInstallasi.daily_report');
Route::post('/JasaInstallasi/MonthlyReport', 'JasaInstallasi\JasaInstallasiController@monthly_report')->name('JasaInstallasi.monthly_report');
Route::resource('JasaPrint', 'JasaPrint\JasaPrintController');
Route::post('/JasaPrint/DailyReport', 'JasaPrint\JasaPrintController@daily_report')->name('JasaPrint.daily_report');
Route::post('/JasaPrint/MonthlyReport', 'JasaPrint\JasaPrintController@monthly_report')->name('JasaPrint.monthly_report');
Route::resource('Laboratorium', 'Lab\LabController');
Route::get('/Alat/all', 'Alat\AlatController@all')->name('Alat.all');
Route::resource('Alat', 'Alat\AlatController');
Route::resource('Mahasiswa', 'Mahasiswa\MahasiswaController');
Route::resource('Prodi', 'Prodi\ProdiController');
Route::get('/Dosen/all', 'Dosen\DosenController@all')->name('Dosen.all');
Route::resource('Dosen', 'Dosen\DosenController');
Route::resource('MataKuliah', 'MataKuliah\MataKuliahController');
Route::get('/Jadwal/all', 'Jadwal\JadwalController@all')->name('Jadwal.all');
Route::resource('Jadwal', 'Jadwal\JadwalController');
Route::resource('Software', 'Software\SoftwareController');
Route::resource('User', 'User\UserController');
