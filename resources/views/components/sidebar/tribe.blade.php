<li class="menu">
    <a href="#tribemenu" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'tribe') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div class="">
            <i class="fas fa-campground"></i>
            <span> Tribe</span>
        </div>
        <div>
            @include('components.sidebar.sidebar-arrow')
        </div>
    </a>
    <ul class="collapse submenu list-unstyled {{ strpos($routeName, 'tribe') !== false ? 'show' : ""}}" id="tribemenu" data-parent="#userSidebar">
        @if(Auth::user()->tribe_id != null)
            @if(Auth::user()->tribe->isUserTribeOwner)
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
                <li class="{{ $routeName == 'tribe.user.manage' ? 'active' : '' }}">
                    <a href="{{ route('tribe.user.manage') }}">
                        <i class="fas fa-users-cog"></i> Manage Tribemates
                    </a>
                </li>
            @endif
            <li class="{{ $routeName == 'tribe.view' ? 'active' : '' }}">
                <a href="{{ route('tribe.view', $user->tribe->uuid) }}">
                    <i class="far fa-eye"></i> View Tribe
                </a>
            </li>
        @else
            <li class="{{ $routeName == 'tribe.create' ? 'active' : '' }}">
                <a href="{{ route('tribe.create') }}"><i class="far fa-plus-square"></i> Create Tribe</a>
            </li>
        @endif
    </ul>
</li>
