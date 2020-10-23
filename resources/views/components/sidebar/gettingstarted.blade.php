<li class="menu">
    <!-- Sidebar Parent Title -->
    <a href="#getting-started" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'help') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div>
            <i class="fas fa-info-circle"></i>
            <span>Getting Started</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>

    <!-- Dropdown Menu -->
    <ul class="submenu list-unstyled collapse {{ strpos($routeName, 'tribe') !== false ? 'show' : ""}}" id="getting-started" data-parent="#userSidebar">

        <li class="{{ $routeName == 'help.tribe' ? 'active' : '' }}">
            <a href="#">
                <i class="fas fa-campground"></i> Tribe
            </a>
        </li>

        <li class="{{ $routeName == 'help.dinobreed' ? 'active' : '' }}">
            <a href="#">
                <i class="fas fa-baby"></i> Dino Breeding
            </a>
        </li>

        <li class="{{ $routeName == 'help.dinocolor' ? 'active' : '' }}">
            <a href="#">
                <i class="fas fa-palette"></i> Dino Colors
            </a>
        </li>

        <li class="{{ $routeName == 'help.blueprint' ? 'active' : '' }}">
            <a href="#">
                <i class="fas fa-pencil-ruler"></i> Blueprint Tracker
            </a>
        </li>

    </ul>
</li>
