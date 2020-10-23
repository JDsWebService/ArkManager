@extends('layouts.user')

@section('title', 'Create New Tribe')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-8">
            {{ Form::open(['route' => 'tribe.store', 'method' => 'POST']) }}

                <label for="name">Tribe Name</label>
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tribe Name']) }}

                <label for="founded_on" class="mt-3">Founded On</label>
                {{ Form::date('founded_on', null, ['class' => 'form-control']) }}

                <button class="btn btn-success btn-block mt-3" value="submit">
                    <i class="far fa-plus-square"></i> Create New Tribe
                </button>

            {{ Form::close() }}
        </div>
    </div>

@endsection
