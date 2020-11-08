<li class="menu">
    <!-- Sidebar Parent Title -->
    <a href="#dino-menu" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'user.dino') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div>
            <i class="fas fa-dragon"></i>
            <span>Dinos</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>

    <!-- Dropdown Menu -->
    <ul class="submenu list-unstyled collapse {{ strpos($routeName, 'user.dino') !== false ? 'show' : ""}}" id="dino-menu" data-parent="#userSidebar">

        <li class="{{ $routeName == 'user.dino.import' ? 'active' : '' }}">
            <a href="{{ route('dino.import') }}">
                <i class="fas fa-file-import"></i> Import From INI
            </a>
        </li>



    </ul>
</li>