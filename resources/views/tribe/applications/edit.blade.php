@extends('layouts.user')

@section('title', 'Edit Tribe Application')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ Form::model($application, ['route' => ['tribe.applications.update', $application->uuid], 'method' => 'PUT']) }}

            <label for="title">Application Title</label>
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enticing Title Goes Here']) }}

            <p class="text-info font-italic my-3">Note: In this section you should describe how an application should apply to your tribe, and the methods to reach you such as Discord, Twitter, etc. You may also want to put requirements for the applicant such as minimum number of played hours, native language, age, etc. In your application you must not break any of the ArkManager Tos, or Privacy Policies.</p>
            <x-tiny-m-c-e-editor id="description" margin="true" model="{{ $application->description }}"/>

            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <button class="btn btn-block btn-success mt-3" type="submit">
                        Save Tribe Application
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection
