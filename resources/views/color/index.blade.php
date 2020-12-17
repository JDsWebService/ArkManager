@extends('layouts.user')

@section('title', 'Your Tracked Color Dinos')

@section('content')

    <div class="row justify-content-center">
        @foreach($dinoNames as $id => $metaInfo)

            <div class="col-sm-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-sm-4 align-items-center">
                            <img src="{{ $metaInfo->image_public_path }}" alt="{{ $metaInfo->name }} Icon" class="h-100">
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $metaInfo->name }}</h5>
                                <a href="{{ route('color.view', $id) }}" class="btn btn-primary btn-sm m-0">View Colors</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

@endsection
