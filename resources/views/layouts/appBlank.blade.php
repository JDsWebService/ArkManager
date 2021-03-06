<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.app.head')
</head>

<body>
@include('partials.user.preloader')
@include('modals.app.messages')

@if(Auth::check())
    @if(Auth::user()->isAdmin == true)
        <!-- Navbar & Hero Post-Release Includes -->
        @include('partials.app.navbar')
        @include('content.app.hero')
    @else
        <!-- Navbar & Hero Pre-Release Includes -->
        @include('partials.app.navbar-beta')
        @include('content.app.hero-beta')
    @endif
@else
    <!-- Navbar & Hero Pre-Release Includes -->
    @include('partials.app.navbar-beta')
    @include('content.app.hero-beta')
@endif


<main id="main">

    <div class="container mt-3 mb-5">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <h1>@yield('title')</h1>
                <hr>
            </div>
        </div>
        @yield('content')
    </div>

</main><!-- End #main -->

@include('partials.app.footer')

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

@include('partials.app.scripts')

</body>

</html>
