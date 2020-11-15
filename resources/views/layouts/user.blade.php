<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.user.head')
</head>

<body>
@include('partials.user.preloader')
@include('modals.app.messages')

@include('partials.user.topnav')
@include('partials.user.subnav')

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <x-user-sidebar/>

    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">

                <div class="col-sm-12 mb-5">
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

<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

</body>
</html>
