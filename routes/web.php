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

// ------------------------------------------------------ //
// All routes in the block must be authorized as an admin
// ------------------------------------------------------ //
Route::middleware('auth.admin')->group(function () {

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('dashboard', 'Admin\AdminController@dashboard')->name('dashboard');

    });
    // Testing Route for debugging purposes.
    Route::get('test', 'TestingController@test2')->name('test');
});


// ------------------------------------------------- //
// All Routes In This Block Must Have User Logged In //
// ------------------------------------------------- //
Route::middleware('auth')->group(function () {

    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('dashboard', 'User\MainController@dashboard')->name('dashboard');
    });

    // Dino Routes
    Route::prefix('dino')->name('dino.')->group(function () {
        Route::get('import', 'Dino\DinoController@import')->name('import');
        Route::post('parse', 'Dino\DinoController@parse')->name('parse');
    });

    // Tribe Routes
    Route::prefix('tribe')->name('tribe.')->group(function () {

        Route::get('create', 'Tribe\TribeController@create')->name('create');
        Route::post('store', 'Tribe\TribeController@store')->name('store');
        Route::get('edit', 'Tribe\TribeController@edit')->name('edit');
        Route::put('update', 'Tribe\TribeController@update')->name('update');

    });

});

// Socialite Login
Route::get('login/discord', 'Auth\LoginController@redirectToProvider')
    ->name('login.discord');
Route::get('logout', 'Auth\LoginController@logout')
    ->name('logout');
Route::get('login/discord/callback', 'Auth\LoginController@handleProviderCallback');

// Coming Soon Routes
Route::get('coming-soon', 'PagesController@comingsoon')->name('comingsoon');
Route::post('subscribe', 'PagesController@subscribe')->name('subscribe');

// New Template Testing Route
//Route::get('/testing', function () {
//    return redirect()->route('comingsoon');
//})->name('testing');

// Site Homepage (Index)
Route::get('/', 'PagesController@index')->name('index');
//Route::get('/', 'PagesController@comingsoon')->name('index');
