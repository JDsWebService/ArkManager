<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AdminSidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $routeName = \Illuminate\Support\Facades\Route::currentRouteName();
        $user = Auth::user();

        return view('components.admin-sidebar')
            ->withRouteName($routeName)
            ->withUser($user);
    }
}
