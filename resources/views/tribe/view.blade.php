@extends('layouts.user')

@section('title', 'Viewing ' . $tribe->name . ' Tribe')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-4">
            @include('tribe.partials.tribeCard', ['tribe' => $tribe])
        </div>
        <div class="col-sm-8">
            <h4>Tribe Description</h4>
            <hr>
            {!! $tribe->description !!}
        </div>
    </div>

@endsection
