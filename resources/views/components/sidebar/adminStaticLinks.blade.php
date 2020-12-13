<li class="menu">
    <a href="{{ route('admin.dashboard') }}" {{ $routeName == 'admin.dashboard' ? 'data-active=true' : "" }} aria-expanded="false" class="dropdown-toggle">
        <div>
            <i class="fas fa-tachometer-alt"></i>
            <span> Admin Dashboard</span>
        </div>
    </a>
</li>

@include('components.sidebar.dashboard')

<li class="menu">
    <a href="{{ route('admin.test') }}" {{ $routeName == 'admin.test' ? 'data-active=true' : "" }} aria-expanded="false" class="dropdown-toggle">
        <div>
            <i class="fas fa-umbrella-beach"></i>
            <span> Admin Sandbox</span>
        </div>
    </a>
</li>

<li class="menu">
    <a href="{{ route('admin.force.login.form') }}" {{ $routeName == 'admin.force.login.form' ? 'data-active=true' : "" }} aria-expanded="false" class="dropdown-toggle">
        <div>
            <i class="fas fa-jedi"></i>
            <span> Force Login</span>
        </div>
    </a>
</li>
