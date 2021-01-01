<li class="menu">
    <a href="#tribe-menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
        {{ strpos($routeName, 'tribe') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div class="">
            <i class="fas fa-campground"></i>
            <span>Tribe</span>
        </div>
        <div>
            @include('components.sidebar.sidebar-arrow')
        </div>
    </a>
    <ul class="collapse submenu list-unstyled {{ strpos($routeName, 'tribe') !== false ? 'show' : ""}}" id="tribe-menu" data-parent="#userSidebar">

        <!-- Tribe Management Deep Dropdown -->
        <li class="my-2">
            <a href="#tribeManagementDeep" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" {{ strpos($routeName, 'tribe.management') !== false ? 'aria-expanded=true data-active=true' : ""}}>
                Management
                @include('components.sidebar.sidebar-arrow')
            </a>
            <ul class="collapse list-unstyled sub-submenu {{ strpos($routeName, 'tribe.management') !== false ? 'show' : ""}}" id="tribeManagementDeep" data-parent="#tribe-menu">
                @if(Auth::user()->tribe_id != null)
                    @if(Auth::user()->tribe->isUserTribeOwner)
                        <li class="{{ $routeName == 'tribe.management.edit' ? 'active' : '' }}">
                            <a href="{{ route('tribe.management.edit', $user->tribe->uuid) }}">
                                <i class="far fa-edit"></i> Edit Your Tribe
                            </a>
                        </li>
                        <li class="{{ $routeName == 'tribe.management.user.add' ? 'active' : '' }}">
                            <a href="{{ route('tribe.management.user.add', $user->tribe->uuid) }}">
                                <i class="fas fa-user-plus"></i> Add Tribemate
                            </a>
                        </li>
                        <li class="{{ $routeName == 'tribe.management.user.manage' ? 'active' : '' }}">
                            <a href="{{ route('tribe.management.user.manage') }}">
                                <i class="fas fa-users-cog"></i> Manage Tribemates
                            </a>
                        </li>
                    @endif
                    <li class="{{ $routeName == 'tribe.management.view' ? 'active' : '' }}">
                        <a href="{{ route('tribe.management.view', $user->tribe->uuid) }}">
                            <i class="far fa-eye"></i> View Tribe
                        </a>
                    </li>
                @else
                    <li class="{{ $routeName == 'tribe.management.create' ? 'active' : '' }}">
                        <a href="{{ route('tribe.management.create') }}"><i class="far fa-plus-square"></i> Create Tribe</a>
                    </li>
                @endif
            </ul>
        </li>

        @if(Auth::user()->tribe_id != null && Auth::user()->tribe->isUserTribeOwner)
        <!-- Tribe Application Deep Dropdown -->
        <li class="my-2">
            <a href="#tribeApplicationDeep" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" {{ strpos($routeName, 'tribe.applications') !== false ? 'aria-expanded=true data-active=true' : ""}}>
                Applications
                @include('components.sidebar.sidebar-arrow')
            </a>
            <ul class="collapse list-unstyled sub-submenu {{ strpos($routeName, 'tribe.applications') !== false ? 'show' : ""}}" id="tribeApplicationDeep" data-parent="#tribe-menu">
                @if(Auth::user()->tribe->application == null)
                    <li class="{{ $routeName == 'tribe.applications.create' ? 'active' : '' }}">
                        <a href="{{ route('tribe.applications.create') }}">
                            <i class="far fa-plus-square"></i> Create Tribe Application
                        </a>
                    </li>
                @else
                    <li class="{{ $routeName == 'tribe.applications.edit' ? 'active' : '' }}">
                        <a href="{{ route('tribe.applications.edit', Auth::user()->tribe->application->uuid) }}">
                            <i class="far fa-plus-square"></i> Edit Tribe Application
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        @endif
    </ul>
</li>
