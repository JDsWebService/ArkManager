<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use App\View\Components\SocialMediaButton as SocialMediaButtonAlias;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Checks to see if the user is a staff member.
         *
         * @return bool
         */
        Blade::if('staff', function() {
            $adminStatus = Auth::user()->admin;
            if($adminStatus == true) {
                return true;
            }
            // Return false if not staff
            return false;
        });

        /**
         * Defines the default pagination view.
         */
        Paginator::defaultView('vendor.pagination.user');

        /**
         * Share the view name with all views!
         */
        view()->composer('*', function($view) {
            view()->share('viewName', $view->getName());
        });

        /**
         * Share the root view name with all views!
         */
        view()->composer('*', function($view) {
            $data = explode('.', $view->getName());
            $rootViewName = $data[0];
            view()->share('rootViewName', $rootViewName);
        });

        /**
         * Share the root name with all views!
         */
        view()->composer('*', function($view) {
            $routeName = Route::currentRouteName();
            view()->share('routeName', $routeName);
        });

    }
}
