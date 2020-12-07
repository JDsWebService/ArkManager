@extends('layouts.user')

@section('title', 'Edit Tribe - '. $tribe->name)

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ Form::model($tribe, ['route' => ['tribe.update', $tribe->uuid], 'method' => 'PUT', 'files' => true]) }}

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <label for="name">Tribe Name</label>
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tribe Name']) }}

                    <label for="founded_on" class="mt-3">Founded On</label>
                    {{ Form::date('founded_on', null, ['class' => 'form-control']) }}

                    <label for="home_server_id" class="mt-3">Home Server</label>
                    {{ Form::select('home_server_id', $servers, null, ['class' => 'form-control']) }}

                    <x-file-upload-input label="Tribe Profile Image" name="tribeProfileImage"/>

                    <button class="btn btn-success btn-block mt-3" value="submit">
                        <i class="fas fa-save"></i> Save Tribe
                    </button>
                </div>

            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
