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

// Socialite Login
Route::get('login/discord', 'Auth\LoginController@redirectToProvider')
            ->name('login.discord');
Route::get('logout', 'Auth\LoginController@logout')
            ->name('logout');
Route::get('login/discord/callback', 'Auth\LoginController@handleProviderCallback');

Route::prefix('user')->middleware('auth')->name('user.')->group(function () {
    Route::get('dashboard', 'User\MainController@dashboard')->name('dashboard');
});

// Coming Soon Routes
Route::get('coming-soon', 'PagesController@comingsoon')->name('comingsoon');
Route::post('subscribe', 'PagesController@subscribe')->name('subscribe');

// New Template Testing Route
Route::get('/testing', function () {
    return redirect()->route('comingsoon');
})->name('testing');

// Site Homepage (Index)
Route::get('/', 'PagesController@index')->name('index');
