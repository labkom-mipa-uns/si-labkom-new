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
Route::get('/SuratBebasLabkom/all', 'SuratBebasLabkom\SuratBebasLabkom@all')->name('SuratBebasLabkom.all');
Route::resource('SuratBebasLabkom', 'SuratBebasLabkom\SuratBebasLabkomController');
Route::get('/JasaInstallasi/all', 'JasaInstallasi\JasaInstallasiController@al')->name('JasaInstallasi.all');
Route::resource('JasaInstallasi', 'JasaInstallasi\JasaInstallasiController');
Route::post('/JasaInstallasi/DailyReport', 'JasaInstallasi\JasaInstallasiController@daily_report')->name('JasaInstallasi.daily_report');
Route::post('/JasaInstallasi/MonthlyReport', 'JasaInstallasi\JasaInstallasiController@monthly_report')->name('JasaInstallasi.monthly_report');
Route::get('/JasaPrint/all', 'JasaPrint\JasaPrintController@all')->name('JasaPrint.all');
Route::resource('JasaPrint', 'JasaPrint\JasaPrintController');
Route::post('/JasaPrint/DailyReport', 'JasaPrint\JasaPrintController@daily_report')->name('JasaPrint.daily_report');
Route::post('/JasaPrint/MonthlyReport', 'JasaPrint\JasaPrintController@monthly_report')->name('JasaPrint.monthly_report');
Route::get('/Laboratorium/all', 'Lab\LabController@all')->name('Laboratorium.all');
Route::resource('Laboratorium', 'Lab\LabController');
Route::get('/Alat/all', 'Alat\AlatController@all')->name('Alat.all');
Route::resource('Alat', 'Alat\AlatController');
Route::get('/Mahasiswa/all', 'Mahasiswa\MahasiswaController@all')->name('Mahasiswa.all');
Route::resource('Mahasiswa', 'Mahasiswa\MahasiswaController');
Route::get('/Prodi/all', 'Prodi\ProdiController@all')->name('Prodi.all');
Route::resource('Prodi', 'Prodi\ProdiController');
Route::get('/Dosen/all', 'Dosen\DosenController@all')->name('Dosen.all');
Route::resource('Dosen', 'Dosen\DosenController');
Route::get('/MataKuliah/all', 'MataKuliah\MataKuliahController@all')->name('MataKuliah.all');
Route::resource('MataKuliah', 'MataKuliah\MataKuliahController');
Route::get('/Jadwal/all', 'Jadwal\JadwalController@all')->name('Jadwal.all');
Route::resource('Jadwal', 'Jadwal\JadwalController');
Route::get('/Software/all', 'Software\SoftwareController@all')->name('Software.all');
Route::resource('Software', 'Software\SoftwareController');
Route::resource('User', 'User\UserController');
