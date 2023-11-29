<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', 'App\Http\Controllers\LoginController@goToLoginPage')->name('login-page');
Route::any('index/begin', 'App\Http\Controllers\LoginController@controlForLogin')->name('home-page');

Route::get('/deneme', 'App\Http\Controllers\StudentController@example');