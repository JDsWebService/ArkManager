<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.app.head')
    </head>

    <body>
        @include('partials.user.preloader')
        @include('modals.app.messages')

        <!-- Navbar & Hero Post-Release Includes -->
        <!-- include('partials.app.navbar') -->
        <!-- include('content.app.hero-beta') -->

        <!-- Navbar & Hero Pre-Release Includes -->
        @include('partials.app.navbar-beta')
        @include('content.app.hero-beta')

        <main id="main">

            @yield('content')

        </main><!-- End #main -->

        @include('partials.app.footer')

        <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

        @include('partials.app.scripts')

    </body>

</html>
