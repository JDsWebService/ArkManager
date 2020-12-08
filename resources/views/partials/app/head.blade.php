<!-- Meta Tags -->
@include('partials.metatags')

<title>ArkManager.app - @yield('title')</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Favicons -->
@include('partials.favicons')

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/0d9c5a4db2.js" crossorigin="anonymous"></script>
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/iiymszi5ey6bty2irx4oyirzn9uugi59vj1010ne9h3wjvar/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
