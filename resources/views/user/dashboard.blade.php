@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')

    <div class="callout callout-info">
        <h4>We're looking for your help!</h4>
        <p>Welcome to ArkManager! This application will help you keep track of your dinos, dino colors, blueprints, and more! We are actively looking for developers to help with this open source project! If you would like to become a developer, please visit our <a href="https://github.com/JDsWebService/ArkManager" class="text-primary">Github Page</a>.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <h3>Getting Started</h3>
                    <hr>
                    <p>
                        If at any point you have any issues navigating around the site, feel free to check out our documentation articles found <a href="{{ route('documentation.index') }}" class="text-primary">here</a>. A good rule of thumb is to create a Tribe first, or have your Tribes owner send you an invite to join your tribe, and then take a look around. Some features on the site require that you be in a tribe in order to use them.
                    </p>
                </div>
                <div class="col-sm-6">
                    <h3>Bug Reporting</h3>
                    <hr>
                    <p>
                        If you find any bugs on the site, please open a ticket up in <a href="https://discord.gg/QuafdYEEQB">Our Discord</a>. We will respond to your ticket as soon as possible, and hopefully get you a fix to your issue.
                    </p>
                </div>
            </div>

        </div>
    </div>

@endsection
