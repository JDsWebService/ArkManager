@extends('layouts.user')

@section('title', 'Create New Tribe')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ Form::open(['route' => 'tribe.store', 'method' => 'POST', 'files' => true]) }}

            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <label for="name">Tribe Name</label>
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tribe Name']) }}

                    <label for="founded_on" class="mt-3">Founded On</label>
                    {{ Form::date('founded_on', null, ['class' => 'form-control']) }}

                    <label for="home_server_id" class="mt-3">Home Server</label>
                    {{ Form::select('home_server_id', $servers, null, ['class' => 'form-control']) }}

                    <x-file-upload-input label="Tribe Profile Image" name="tribeProfileImage"/>
                </div>
                <div class="col-sm-6">
                    <x-tiny-m-c-e-editor placeholder="Tribe Description" id="description" label="Tribe Description"/>

                    <label for="discord_link" class="mt-3">Discord Invite Link</label>
                    {{ Form::text('discord_link', null, ['class' => 'form-control', 'placeholder'=> 'https://discord.gg/your_link_here']) }}
                </div>

            </div> <!-- ./row-->

            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <button class="btn btn-success btn-block mt-3" value="submit">
                        <i class="fas fa-save"></i> Save Tribe
                    </button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
