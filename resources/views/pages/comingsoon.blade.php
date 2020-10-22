<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>ArkManager.app - Coming Soon!</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ mix('css/user.css') }}">
    <link rel="stylesheet" href="{{ mix('css/coming-soon/style.css') }}">
    <link rel="stylesheet" href="{{ mix('css/coming-soon/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" href="{{ mix('css/coming-soon/switches.css') }}">
</head>
<body class="coming-soon">

@include('partials.user.preloader')

@include('modals.app.messages')

<div class="coming-soon-container">
    <div class="coming-soon-cont">
        <div class="coming-soon-wrap">
            <div class="coming-soon-container">
                <div class="coming-soon-content">

                    <h4 class="">Coming Soon</h4>
                    <p class="">We will be here in a shortwhile.....</p>

                    <h3>Subscribe to get notified!</h3>

                    {{ Form::open(['route' => 'subscribe', 'method' => 'POST']) }}
                        <div class="coming-soon text-left">

                            <div id="email-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>

                                    <input id="email" name="email" class="form-control" type="text" value="" placeholder="Email">
                                    <button type="submit" class="btn btn-success" value="">Subscribe</button>

                            </div>

                        </div>
                    {{ Form::close() }}

                    <p class="terms-conditions">
                        © {{ \Carbon\Carbon::now()->year }} ArkManager.app, All Rights Reserved.
                    </p>

                </div>
            </div>
        </div>
    </div>
    <div class="coming-soon-image">
        <div class="l-image">
            <div class="img-content">
                <img src="/images/user/mindset.svg" alt="coming_soon">
            </div>
        </div>
    </div>
</div>

<script src="{{ mix('js/user.js') }}"></script>
<script src="{{ mix('js/coming-soon/coming-soon.js') }}"></script>

</body>
</html>
