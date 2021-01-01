@extends('layouts.admin')

@section('title', 'Image Manipulation')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-sm-4 align-items-center" style="font-size:75px;">
                        <i class="fas fa-dragon pl-3"></i>
                    </div>
                    <div class="col-sm-8">
                        <div class="card-body">
                            <h5 class="card-title">Dino Images</h5>
                            <a href="{{ route('admin.images.dino.index') }}" class="btn btn-primary btn-sm m-0">Invert Colors</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
