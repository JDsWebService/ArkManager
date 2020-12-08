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

// https://github.com/laravel/framework/issues/18613#issuecomment-341991605
$url = config('app.url');
URL::forceRootUrl($url);

// ------------------------------------------------------ //
// All routes in the block must be authorized as an admin
// ------------------------------------------------------ //
Route::prefix('admin')
        ->name('admin.')
        ->middleware('auth.admin')
        ->group(function () {

    Route::get('dashboard', 'Admin\AdminController@dashboard')
            ->name('dashboard');

    // Admin Changelog Routes
    Route::prefix('changelog')->name('changelog.')->group(function () {
        Route::get('add', 'Admin\ChangelogController@add')
            ->name('add');
        Route::post('store', 'Admin\ChangelogController@store')
            ->name('store');
        Route::get('edit/{id}', 'Admin\ChangelogController@edit')
            ->name('edit');
        Route::put('update/{id}', 'Admin\ChangelogController@update')
            ->name('update');
        Route::delete('delete/{id}', 'Admin\ChangelogController@delete')
            ->name('delete');
        Route::get('/', 'Admin\ChangelogController@index')
            ->name('index');
    });

    // Testing Route for debugging purposes.
    Route::get('test', 'TestingController@test')->name('test');
});


// ------------------------------------------------- //
// All Routes In This Block Must Have User Logged In //
// ------------------------------------------------- //
/// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!///
/// !!!!!!!!! Added auth.admin for testing purposes on production !!!!!!!! ///
/// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! ///
Route::middleware(['auth', 'user.accept.conditions', 'auth.admin'])->group(function () {

    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('settings', 'User\MainController@settings')->name('settings');
        Route::post('settings', 'User\MainController@storeSettings')->name('settings.store');
        Route::get('dashboard', 'User\MainController@dashboard')->name('dashboard');
    }); // End User Routes

    // Tribe Routes
    Route::prefix('tribe')->name('tribe.')->group(function () {
        Route::get('create', 'Tribe\TribeController@create')
                ->name('create');
        Route::post('store', 'Tribe\TribeController@store')
                ->name('store');
        Route::get('edit/{uuid}', 'Tribe\TribeController@edit')
                ->name('edit');
        Route::put('update/{uuid}', 'Tribe\TribeController@update')
                ->name('update');

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('add/{uuid}', 'Tribe\TribeController@addUser')
                ->name('add');
            Route::post('sendEmail/{uuid}', 'Tribe\TribeController@sendTribeInviteEmail')
                ->name('sendEmail');
            Route::get('acceptInvite/{token}', 'Tribe\TribeController@acceptInvite')
                ->name('acceptInvite');
        });
    }); // End Tribe Routes

    // Dino Routes
    Route::prefix('dino')
           ->name('dino.')
           ->middleware('user.intribe')
           ->group(function () {

        Route::get('new/base-dino', 'Dino\DinosController@newBaseDino')
                ->name('new.base');
        Route::post('store/base-dino', 'Dino\DinosController@storeBaseDino')
                ->name('store.base');
        Route::get('show/line/{uuid}', 'Dino\DinosController@showLine')
                ->name('show.line');
        Route::get('edit/base-dino/{slug}', 'Dino\DinosController@editBaseDino')
                ->name('edit.base');
        Route::put('update/base-dino/{slug}', 'Dino\DinosController@updateBaseDino')
                ->name('update.base');
        Route::delete('destroy/line/{uuid}', 'Dino\DinosController@destroyLine')
                ->name('destroy.line');
        Route::get('new/mutation/{uuid}', 'Dino\DinosController@newMutatedDino')
                ->name('new.mutation');
        Route::post('store/mutation/{uuid}', 'Dino\DinosController@storeMutatedDino')
                ->name('store.mutation');
        Route::get('edit/mutated-dino/{slug}', 'Dino\DinosController@editMutatedDino')
                ->name('edit.mutation');
        Route::put('update/mutated-dino/{slug}', 'Dino\DinosController@updateMutatedDino')
                ->name('update.mutation');
        Route::delete('destroy/mutation/{slug}', 'Dino\DinosController@destroyMutatedDino')
                ->name('destroy.mutation');
        Route::get('/', 'Dino\DinosController@index')->name('index');
    }); // End Dino Routes

    // Trade Hub Routes
    Route::prefix('trade')
            ->name('trade.')
            ->middleware(['user.notifications', 'user.intribe'])
            ->group(function () {

        Route::prefix('new')->name('new.')->group(function () {
            Route::get('select/items', 'Trade\TradeHubController@newTrade')
                ->name('select.items');
            Route::get('config/items', 'Trade\TradeHubController@configItems')
                ->name('config.items');
            Route::post('summary', 'Trade\TradeHubController@tradeSummary')
                ->name('summary');
            Route::post('store', 'Trade\TradeHubController@storeNewTrade')
                ->name('store');
        });

        Route::prefix('edit')->name('edit.')->group(function () {
            Route::get('{uuid}', 'Trade\TradeHubController@editTrade')
                ->name('trade');
            Route::post('summary/{uuid}', 'Trade\TradeHubController@editTradeSummary')
                ->name('summary');
            Route::post('store/{uuid}', 'Trade\TradeHubController@storeEditTrade')
                ->name('store');
        });

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', 'Trade\TradeHubController@userIndex')
                ->name('index');
        });

        Route::get('view/{uuid}', 'Trade\TradeHubController@view')
                ->name('view');
        Route::put('renew/{uuid}', 'Trade\TradeHubController@renew')
                ->name('renew');
        Route::delete('delete/{uuid}', 'Trade\TradeHubController@delete')
                ->name('delete');

        Route::get('/', 'Trade\TradeHubController@index')->name('index');

    });

}); // End User Must Be Logged In Routes Group

// Socialite Login
Route::get('login/discord', 'Auth\LoginController@redirectToProvider')
    ->name('login.discord');
Route::get('logout', 'Auth\LoginController@logout')
    ->name('logout');
Route::get('login/discord/callback', 'Auth\LoginController@handleProviderCallback');

// Privacy and TOS Routes
Route::get('privacy', 'PagesController@privacy')->name('privacy');
Route::get('terms-of-service', 'PagesController@termsOfService')->name('terms');
Route::get('accept-conditions', 'PagesController@acceptConditions')->name('accept.conditions');
Route::post('accept-conditions', 'PagesController@acceptConditionsStore')->name('accept.conditions.store');

// Site Homepage (Index)
Route::get('/', 'PagesController@index')->name('index');
