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
                <div class="col-sm-4">
                    <h4>Breeding Tracker Settings</h4>
                    <hr>

                    <div class="custom-control custom-switch">
                        {{ Form::checkbox('use_true_values', true, $tribe->use_true_values, ['class' => 'custom-control-input', 'id' => 'use_true_values']) }}
                        <label class="custom-control-label" for="use_true_values">
                            Use True Values
                            <span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="top" title="Use true values for stats. These values are found in the dino inventory screen in-game.">?</span>
                        </label>
                    </div>
                    <div class="custom-control custom-switch mt-3">
                        {{ Form::checkbox('use_stat_levels', true, $tribe->use_stat_levels, ['class' => 'custom-control-input', 'id' => 'use_stat_levels']) }}
                        <label class="custom-control-label" for="use_stat_levels">
                            Use Stat Levels
                            <span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="top" title="Use stat levels. These can only be used if you have a mod such as Awesome Spy Glass installed.">?</span>
                        </label>
                    </div>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
