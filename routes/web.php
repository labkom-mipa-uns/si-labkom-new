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
Route::resource('Account', 'Account\AccountController')->except('create');
Route::resource('PeminjamanLab', 'PeminjamanLab\PeminjamanLabController')->except('show');
Route::resource('PeminjamanAlat', 'PeminjamanAlat\PeminjamanAlatController')->except('show');
Route::resource('SuratBebasLabkom', 'SuratBebasLabkom\SuratBebasLabkomController')->except('show');
Route::resource('JasaInstallasi', 'JasaInstallasi\JasaInstallasiController')->except('show');
Route::resource('JasaPrint', 'JasaPrint\JasaPrintController')->except('show');
