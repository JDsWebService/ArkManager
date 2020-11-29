<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.user.head')
</head>

<body>
@include('partials.user.preloader')
@include('modals.app.messages')

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="layout-px-spacing">

                <div class="row">

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
    </div>
</div>

<script src="{{ mix('js/user.js') }}"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

</body>
</html>
