@extends('layouts.user')

@section('title', 'Upload INI File')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <p class="lead">Upload your exported dino's INI file. For more information on where to find your exported dino's INI file, or how to export a dino, check out our <a href="https://arkmanager.app/documentation/Getting%20Started/exporting-a-dino-from-ark-1-1608240538" target="_blank" class="text-info">Exporting A Dino From Ark</a> documentation.</p>

            {{ Form::open(['route' => 'color.parse', 'method' => 'POST', 'files' => true]) }}

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <x-file-upload-input name="inifile" label="INI File"/>
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
