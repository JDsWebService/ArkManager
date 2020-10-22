<?php

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

// Site Homepage (Index)
Route::get('/', function () {
    return view('welcome');
})->name('index');

// New Template Testing Route
Route::get('/testing', function () {
    return view('user.dashboard');
})->name('testing');

// Socialite Login
Route::get('login/discord', 'Auth\LoginController@redirectToProvider')->name('login.discord');
Route::get('login/discord/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/user/dashboard', 'User\MainController@dashboard')->name('user.dashboard');
