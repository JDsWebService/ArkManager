<li class="menu">
    <!-- Sidebar Parent Title -->
    <a href="#trade-menu" data-toggle="collapse" class="dropdown-toggle" {{ strpos($routeName, 'trade') !== false ? 'aria-expanded=true data-active=true' : ""}}>
        <div>
            <i class="fas fa-balance-scale"></i>
            <span>Trade Hub</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>

    <!-- Dropdown Menu -->
    <ul class="submenu list-unstyled collapse {{ strpos($routeName, 'trade') !== false ? 'show' : ""}}" id="trade-menu" data-parent="#userSidebar">

        <li class="{{ strpos($routeName, 'trade.new') !== false ? 'active' : '' }}">
            <a href="{{ route('trade.new.select.items') }}">
                <i class="far fa-plus-square"></i> New Trade
            </a>
        </li>

        <li class="{{ strpos($routeName, 'trade.user') !== false ? 'active' : '' }}">
            <a href="{{ route('trade.user.index') }}">
                <i class="far fa-eye"></i> Your Trades
            </a>
        </li>

        <li class="{{ $routeName == 'trade.index' ? 'active' : '' }}">
            <a href="{{ route('trade.index') }}">
                <i class="far fa-eye"></i> View All Trades
            </a>
        </li>



    </ul>
</li>
