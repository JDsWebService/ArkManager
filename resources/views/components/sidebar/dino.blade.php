<li class="menu">
    <!-- Sidebar Parent Title -->
    <a href="#dino-menu" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'dino.line') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div>
            <i class="fas fa-dragon"></i>
            <span>Dinos</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>

    <!-- Dropdown Menu -->
    <ul class="submenu list-unstyled collapse {{ strpos($routeName, 'dino.line') !== false ? 'show' : ""}}" id="dino-menu" data-parent="#userSidebar">

        <li class="{{ $routeName == 'dino.line.new' ? 'active' : '' }}">
            <a href="{{ route('dino.line.new') }}">
                <i class="fas fa-baby"></i> New Breeding Line
            </a>
        </li>

        <li class="{{ $routeName == 'dino.line.index' ? 'active' : '' }}">
            <a href="{{ route('dino.line.index') }}">
                <i class="far fa-eye"></i> View Breeding Lines
            </a>
        </li>



    </ul>
</li>
