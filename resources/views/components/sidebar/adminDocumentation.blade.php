<li class="menu">
    <!-- Sidebar Parent Title -->
    <a href="#documentation-menu" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'admin.documentation') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div>
            <i class="fas fa-info-circle"></i>
            <span>Documentation</span>
        </div>
        <div>
            @include('components.sidebar.sidebar-arrow')
        </div>
    </a>

    <!-- Dropdown Menu -->
    <ul class="submenu list-unstyled collapse {{ strpos($routeName, 'admin.documentation') !== false ? 'show' : ""}}" id="documentation-menu" data-parent="#adminSidebar">

        <li class="{{ $routeName == 'admin.documentation.add' ? 'active' : '' }}">
            <a href="{{ route('admin.documentation.add') }}">
                <i class="far fa-plus-square"></i> New Documentation
            </a>
        </li>

        <li class="{{ $routeName == 'admin.documentation.index' ? 'active' : '' }}">
            <a href="{{ route('admin.documentation.index') }}">
                <i class="far fa-eye"></i> View All Docs
            </a>
        </li>




    </ul>
</li>
