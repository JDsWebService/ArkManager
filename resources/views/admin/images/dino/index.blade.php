@extends('layouts.admin')

@section('title', 'Dino Image Inverter')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
            <h3>Current Image</h3>
            <hr>
            {{ $dino->name }}
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-sm-3 text-center">
            <div class="bg-light mb-3">
                <img src="{{ $dino->image_public_path }}" alt="">
            </div>
            <p>
                Does this image need to be inverted?
            </p>
        </div>
    </div>

    <div class="row justify-content-center mt-3 text-center">
        <div class="col-sm-3">
            <a href="{{ route('admin.images.dino.invert', $dino->id) }}" class="btn btn-success">Invert Image</a>
        </div>
        <div class="col-sm-3">
            <a href="{{ route('admin.images.dino.skip', $dino->id) }}" class="btn btn-warning">Skip Image</a>
        </div>
    </div>

@endsection
