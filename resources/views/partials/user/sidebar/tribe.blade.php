<li class="menu">
    <a href="#tribemenu" data-toggle="collapse" {{ strpos($routeName, 'tribe') !== false ? 'aria-expanded=true data-active=true' : ""}} class="dropdown-toggle">
        <div class="">
            <i class="fas fa-campground"></i>
            <span> Tribe</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>
    <ul class="collapse submenu list-unstyled {{ strpos($routeName, 'tribe') !== false ? 'show' : ""}}" id="tribemenu" data-parent="#userSidebar">
        @if($user->tribe != null)
            <li class="{{ $routeName == 'tribe.edit' ? 'active' : '' }}">
                <a href="#"><i class="far fa-edit"></i> Edit Your Tribe</a>
            </li>
        @else
            <li class="{{ $routeName == 'tribe.create' ? 'active' : '' }}">
                <a href="{{ route('tribe.create') }}"><i class="far fa-plus-square"></i> Create Tribe</a>
            </li>
        @endif
    </ul>
</li>
