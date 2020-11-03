<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.user.head')
</head>

<body>
@include('partials.user.preloader')
@include('modals.app.messages')

@include('partials.admin.topnav')
@include('partials.admin.subnav')

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <x-admin-sidebar/>

    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">

                <div class="col-sm-12">
                    <h1>@yield('title')</h1>
                    <hr>
                    @yield('content')
                </div>

            </div>

        </div>
        <!-- Footer -->
        @include('partials.user.footer')
    </div>
    <!--  END CONTENT PART  -->

</div>
<!-- END MAIN CONTAINER -->

<script src="{{ mix('js/user.js') }}"></script>

</body>
</html>
