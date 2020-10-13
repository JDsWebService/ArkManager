<?php

namespace App\Providers;

use App\View\Components\SocialMediaButton as SocialMediaButtonAlias;
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
            // If session isStaff is false redirect to homepage
            if(Session::get('isStaff') === true) {
                return true;
            }
            // Return false if not staff
            return false;
        });

    }
}
