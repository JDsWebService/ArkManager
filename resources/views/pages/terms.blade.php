@extends('layouts.app')

@section('title', 'Terms Of Service')

@section('content')

    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-12">
                @include('content.app.tos')
            </div>
        </div>
    </div>

@endsection
