<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.app.head')
    </head>

    <body>

        @include('partials.app.navbar')

        @include('content.app.hero')

        <main id="main">

            @include('content.app.about')

            @include('content.app.services')

            @include('content.app.features')

            @include('content.app.calltoaction')

            @include('content.app.portfolio')

            @include('content.app.pricing')

            @include('content.app.faq')

            @include('content.app.team')



        </main><!-- End #main -->

        @include('partials.app.footer')

        <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

        @include('partials.app.scripts')

    </body>

</html>
