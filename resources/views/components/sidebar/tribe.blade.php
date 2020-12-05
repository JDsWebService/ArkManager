<li class="menu">
    <a href="#tribemenu" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'tribe') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div class="">
            <i class="fas fa-campground"></i>
            <span> Tribe</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>
    <ul class="collapse submenu list-unstyled {{ strpos($routeName, 'tribe') !== false ? 'show' : ""}}" id="tribemenu" data-parent="#userSidebar">
        @if(Auth::user()->tribe_id != null)
            @if(Auth::user()->id == Auth::user()->tribe->user_id)
                <li class="{{ $routeName == 'tribe.edit' ? 'active' : '' }}">
                    <a href="{{ route('tribe.edit', $user->tribe->uuid) }}">
                        <i class="far fa-edit"></i> Edit Your Tribe
                    </a>
                </li>
                <li class="{{ $routeName == 'tribe.user.add' ? 'active' : '' }}">
                    <a href="{{ route('tribe.user.add', $user->tribe->uuid) }}">
                        <i class="fas fa-user-plus"></i> Add Tribemate
                    </a>
                </li>
            @else
                <li class="{{ $routeName == 'tribe.view' ? 'active' : '' }}">
                    <a href="#">
                        <i class="far fa-eye"></i> View Tribe
                    </a>
                </li>
            @endif
        @else
            <li class="{{ $routeName == 'tribe.create' ? 'active' : '' }}">
                <a href="{{ route('tribe.create') }}"><i class="far fa-plus-square"></i> Create Tribe</a>
            </li>
        @endif
    </ul>
</li>
