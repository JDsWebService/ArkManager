<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserSidebar extends Component
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

        return view('components.user-sidebar')->withRouteName($routeName);
    }
}
