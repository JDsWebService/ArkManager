<!-- User Dashboard -->
<li class="menu">
    <a href="{{ route('user.dashboard') }}" {{ $routeName == 'user.dashboard' ? 'data-active=true' : "" }} aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <i class="fas fa-tachometer-alt"></i>
            <span> Your Dashboard</span>
        </div>
    </a>
</li>

<!-- Documentation -->
<li class="menu">
    <a href="{{ route('documentation.index') }}" target="_blank" aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <i class="fas fa-info-circle"></i>
            <span>Documentation</span>
        </div>
    </a>
</li>
