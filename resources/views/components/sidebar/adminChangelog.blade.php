<li class="menu">
    <!-- Sidebar Parent Title -->
    <a href="#changelog-menu" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'admin.changelog') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div>
            <i class="fas fa-clipboard-list"></i>
            <span>Changelog</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>

    <!-- Dropdown Menu -->
    <ul class="submenu list-unstyled collapse {{ strpos($routeName, 'admin.changelog') !== false ? 'show' : ""}}" id="changelog-menu" data-parent="#adminSidebar">

        <li class="{{ $routeName == 'admin.changelog.add' ? 'active' : '' }}">
            <a href="{{ route('admin.changelog.add') }}">
                <i class="far fa-plus-square"></i> New Changelog Entry
            </a>
        </li>

        <li class="{{ $routeName == 'admin.changelog.index' ? 'active' : '' }}">
            <a href="{{ route('admin.changelog.index') }}">
                <i class="far fa-eye"></i> View Changelog
            </a>
        </li>


    </ul>
</li>
