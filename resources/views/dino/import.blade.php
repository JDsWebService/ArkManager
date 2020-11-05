@extends('layouts.user')

@section('title', 'Import Dino From INI File')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <p class="lead">Upload your exported dino's INI file. For more information on where to find your exported dino's INI file, or how to export a dino, check out our <a href="#" class="text-info">Dino Export/Import Documentation</a>.</p>

            {{ Form::open(['route' => 'dino.parse', 'method' => 'POST', 'files' => true]) }}

                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <x-file-upload-input/>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6">
                        <button class="btn btn-success btn-block" type="submit">
                            <i class="fas fa-upload"></i> Upload File
                        </button>
                    </div>
                </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
