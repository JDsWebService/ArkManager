<li class="menu">
    <!-- Sidebar Parent Title -->
    <a href="#dino-menu" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'dino') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div>
            <i class="fas fa-dragon"></i>
            <span>Dinos</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>

    <!-- Dropdown Menu -->
    <ul class="submenu list-unstyled collapse {{ strpos($routeName, 'dino') !== false ? 'show' : ""}}" id="dino-menu" data-parent="#userSidebar">

        <li class="{{ $routeName == 'dino.new.baseDino' ? 'active' : '' }}">
            <a href="{{ route('dino.new.base') }}">
                <i class="fas fa-baby"></i> New Base Dino
            </a>
        </li>

        <li class="{{ $routeName == 'dino.index' ? 'active' : '' }}">
            <a href="{{ route('dino.index') }}">
                <i class="far fa-eye"></i> View Tracked Dinos
            </a>
        </li>



    </ul>
</li>
