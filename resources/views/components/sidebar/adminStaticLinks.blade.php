<li class="menu">
    <a href="{{ route('admin.dashboard') }}" {{ $routeName == 'admin.dashboard' ? 'data-active=true' : "" }} aria-expanded="false" class="dropdown-toggle">
        <div>
            <i class="fas fa-tachometer-alt"></i>
            <span> Admin Dashboard</span>
        </div>
    </a>
</li>

<!-- User Dashboard -->
<li class="menu">
    <a href="{{ route('user.dashboard') }}" {{ $routeName == 'user.dashboard' ? 'data-active=true' : "" }} aria-expanded="false" class="dropdown-toggle">
        <div class="">
            <i class="fas fa-tachometer-alt"></i>
            <span> Your Dashboard</span>
        </div>
    </a>
</li>

<!-- Admin Testing Route -->
<li class="menu">
    <a href="{{ route('admin.test') }}" {{ $routeName == 'admin.test' ? 'data-active=true' : "" }} aria-expanded="false" class="dropdown-toggle">
        <div>
            <i class="fas fa-umbrella-beach"></i>
            <span> Admin Sandbox</span>
        </div>
    </a>
</li>

<!-- Force Login Route -->
<li class="menu">
    <a href="{{ route('admin.force.login.form') }}" {{ $routeName == 'admin.force.login.form' ? 'data-active=true' : "" }} aria-expanded="false" class="dropdown-toggle">
        <div>
            <i class="fas fa-jedi"></i>
            <span> Force Login</span>
        </div>
    </a>
</li>

<!-- Users Index Route -->
<li class="menu">
    <a href="{{ route('admin.users.index') }}" {{ $routeName == 'admin.users.index' ? 'data-active=true' : "" }} aria-expanded="false" class="dropdown-toggle">
        <div>
            <i class="fas fa-users"></i>
            <span> Users</span>
        </div>
    </a>
</li>
