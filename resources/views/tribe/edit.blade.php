@extends('layouts.user')

@section('title', 'Edit Tribe - '. $tribe->name)

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ Form::model($tribe, ['route' => 'tribe.update', 'method' => 'PUT']) }}

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <h4>Tribe Information</h4>
                    <hr>
                    <label for="name">Tribe Name</label>
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tribe Name']) }}

                    <label for="founded_on" class="mt-3">Founded On</label>
                    {{ Form::date('founded_on', null, ['class' => 'form-control']) }}

                    <button class="btn btn-success btn-block mt-3" value="submit">
                        <i class="fas fa-save"></i> Save Tribe
                    </button>
                </div>

            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
