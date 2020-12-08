<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

{{--        <h1 class="logo mr-auto"><a href="index.html">ArkManager.app</a></h1>--}}
        <!-- Uncomment below if you prefer to use an image logo -->
        <a class="logo mr-auto"></a>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="{{ route('index') }}">Home</a></li>
                <li><a href="https://discord.gg/qPgdqfFTgm">Join Our Discord</a></li>
                <li><a href="{{ route('changelog') }}">Changelog</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Features</a></li>
                <li><a href="#team">Team</a></li>
{{--                <li class="drop-down">--}}
{{--                    <a href="">Drop Down</a>--}}
{{--                    <ul>--}}
{{--                        <li><a href="#">Drop Down 1</a></li>--}}
{{--                        <li class="drop-down"><a href="#">Deep Drop Down</a>--}}
{{--                            <ul>--}}
{{--                                <li><a href="#">Deep Drop Down 1</a></li>--}}
{{--                                <li><a href="#">Deep Drop Down 2</a></li>--}}
{{--                                <li><a href="#">Deep Drop Down 3</a></li>--}}
{{--                                <li><a href="#">Deep Drop Down 4</a></li>--}}
{{--                                <li><a href="#">Deep Drop Down 5</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li><a href="#">Drop Down 2</a></li>--}}
{{--                        <li><a href="#">Drop Down 3</a></li>--}}
{{--                        <li><a href="#">Drop Down 4</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li><a href="#contact">Contact</a></li>
                {{-- Discord Login Button --}}
                @guest
                    <li>
                        <a href="{{ route('login.discord') }}"><i class="fab fa-discord"></i> Login</a>
                    </li>
                @endguest

                {{-- User Logged In Dropdown --}}
                @auth
                    <li class="drop-down">
                        <a href="javascript:void(0)">
                            @if(Auth::user()->avatar != NULL)
                                <img src="{{ Auth::user()->avatar }}" alt="User's Avatar" class="navbar-avatar rounded-circle">
                            @endif
                            {{ Auth::user()->fullusername }}
                        </a>
                        <ul>
                            <li>
                                @staff
                                    <a href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-user-shield"></i> Admin Dashboard
                                    </a>
                                @endstaff
                            </li>
                            <li>
                                <a href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->
