<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <!-- Logo & Title -->
        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('images/logo.png') }}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="{{ route('index') }}" class="nav-link"> ArkManager<span class="text-info">BETA</span></a>
            </li>
        </ul>

        <!-- User Profile Button -->
        <ul class="navbar-item flex-row ml-md-auto">
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <img src="{{ \App\Handlers\UserHandler::getUserAvatar($user) }}" alt="avatar">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div>
                        @staff
                            <div class="dropdown-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-user-lock"></i>
                                    Admin Dashboard
                                </a>
                            </div>
                        @endstaff
                        <div class="dropdown-item">
                            <a href="{{ route('user.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                User Dashboard
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="#">
                                <i class="fas fa-inbox"></i>
                                Inbox
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ route('user.settings') }}">
                                <i class="fas fa-cogs"></i>
                                Settings
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt"></i>
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->
