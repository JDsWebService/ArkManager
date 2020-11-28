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
    Route::get('test', 'TestingController@test3')->name('test');
});


// ------------------------------------------------- //
// All Routes In This Block Must Have User Logged In //
// ------------------------------------------------- //
Route::middleware('auth')->group(function () {

    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('dashboard', 'User\MainController@dashboard')->name('dashboard');
    }); // End User Routes

    // Tribe Routes
    Route::prefix('tribe')->name('tribe.')->group(function () {

        Route::get('create', 'User\Tribe\TribeController@create')->name('create');
        Route::post('store', 'User\Tribe\TribeController@store')->name('store');
        Route::get('edit/{slug}', 'User\Tribe\TribeController@edit')->name('edit');
        Route::put('update', 'User\Tribe\TribeController@update')->name('update');

    }); // End Tribe Routes

    // Dino Routes
    Route::prefix('dino')
           ->name('dino.')
           ->middleware('user.intribe')
           ->group(function () {

        Route::get('new/base-dino', 'Dino\DinosController@newBaseDino')->name('new.base');
        Route::post('store/base-dino', 'Dino\DinosController@storeBaseDino')->name('store.base');
        Route::get('show/line/{uuid}', 'Dino\DinosController@showLine')->name('show.line');
        Route::get('edit/base-dino/{slug}', 'Dino\DinosController@editBaseDino')->name('edit.base');
        Route::put('update/base-dino/{slug}', 'Dino\DinosController@updateBaseDino')->name('update.base');
        Route::delete('destroy/line/{uuid}', 'Dino\DinosController@destroyLine')->name('destroy.line');
        Route::get('new/mutation/{uuid}', 'Dino\DinosController@newMutatedDino')->name('new.mutation');
        Route::post('store/mutation/{uuid}', 'Dino\DinosController@storeMutatedDino')->name('store.mutation');
        Route::get('edit/mutated-dino/{slug}', 'Dino\DinosController@editMutatedDino')->name('edit.mutation');
        Route::put('update/mutated-dino/{slug}', 'Dino\DinosController@updateMutatedDino')->name('update.mutation');
        Route::delete('destroy/mutation/{slug}', 'Dino\DinosController@destroyMutatedDino')->name('destroy.mutation');

        Route::get('/', 'Dino\DinosController@index')->name('index');

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

// Site Homepage (Index)
Route::get('/', 'PagesController@index')->name('index');
// Coming Soon Redirect
//Route::get('/', 'PagesController@comingsoon')->name('index');
