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

Auth::routes();
Route::get('/home', 'Home\HomeController')->name('home');
Route::resource('PeminjamanLab', 'PeminjamanLab\PeminjamanLabController');
Route::resource('PeminjamanAlat', 'PeminjamanAlat\PeminjamanAlatController');
Route::resource('SuratBebasLabkom', 'SuratBebasLabkom\SuratBebasLabkomController');
