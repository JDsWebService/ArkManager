<li class="menu">
    <!-- Sidebar Parent Title -->
    <a href="#getting-started" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'dino.colors') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div>
            <i class="fas fa-palette"></i>
            <span>Dino Colors</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>

    <!-- Dropdown Menu -->
    <ul class="submenu list-unstyled collapse {{ strpos($routeName, 'tribe') !== false ? 'show' : ""}}" id="getting-started" data-parent="#userSidebar">

        <li class="{{ $routeName == 'admin.dino.colors.index' ? 'active' : '' }}">
            <a href="{{ route('admin.dino.colors.index') }}">
                <i class="far fa-eye"></i> View All Colors
            </a>
        </li>

        <li class="{{ $routeName == 'admin.dino.colors.create' ? 'active' : '' }}">
            <a href="{{ route('admin.dino.colors.create') }}">
                <i class="far fa-plus-square"></i> Add New Color
            </a>
        </li>



    </ul>
</li>
