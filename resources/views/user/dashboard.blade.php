@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')

    <div class="callout callout-info">
        <h4>We're looking for your help!</h4>
        <p>Welcome to ArkManager! This application will help you keep track of your dinos, dino colors, blueprints, and more! We are actively looking for developers to help with this open source project! If you would like to become a developer, please visit our Github Page.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <h3>Getting Started</h3>
            <hr>
            <p>
                First, you need to create a tribe. You can do so on this page <a href="{{ route('tribe.create') }}">here</a>. Once you have created your tribe, you can then start accessing the other parts of the website. This includes Dino Breeding Tracker, Dino Color Tracker, Blueprint Tracker, and more over on the sidebar!
            </p>
        </div>
    </div>

@endsection
