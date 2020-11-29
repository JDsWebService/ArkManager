@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @include('content.app.about')

    @include('content.app.services')

    @include('content.app.features')

    @include('content.app.calltoaction')

    @include('content.app.pricing')

@endsection
