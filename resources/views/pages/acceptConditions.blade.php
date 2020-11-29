@extends('layouts.userBlank')

@section('title', 'Accept Website Terms & Conditions')

@section('content')

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <p class="lead">Before continuing, please accept our <a href="{{ route('terms') }}">Terms of Service</a> and our
                    <a href="{{ route('privacy') }}">Privacy Policy</a></p>

                <p>We have updated our Terms & Conditions on: 11/29/2020</p>

                {{ Form::open(['route' => 'accept.conditions.store', 'method' => 'POST']) }}
                    <input type="hidden" name="accept" value="true">
                    <button class="btn btn-block btn-primary" type="submit">I Accept These Terms And Conditions</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
