<li class="menu">
    <a href="#dino-menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" {{ strpos($routeName, 'dino') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div class="">
            <i class="fas fa-dragon"></i>
            <span>Dinos</span>
        </div>
        <div>
            @include('components.sidebar.sidebar-arrow')
        </div>
    </a>
    <ul class="collapse submenu list-unstyled {{ strpos($routeName, 'dino') !== false ? 'show' : ""}}" id="dino-menu" data-parent="#userSidebar">
        <!-- Single Link -->
        <!-- <li>
            <a href="javascript:void(0);"> Submenu 1 </a>
        </li> -->
        <!-- Deep Dropdown -->
        <li class="my-2">
            <a href="#dinoMutationDeep" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" {{ strpos($routeName, 'dino') !== false ? 'aria-expanded=true data-active=true' : ""}}>
                Mutation Tracker
                @include('components.sidebar.sidebar-arrow')
            </a>
            <ul class="collapse list-unstyled sub-submenu {{ strpos($routeName, 'dino') !== false ? 'show' : ""}}" id="dinoMutationDeep" data-parent="#dino-menu">
                <li class="{{ $routeName == 'dino.new.base' ? 'active' : '' }}">
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
    </ul>
</li>
