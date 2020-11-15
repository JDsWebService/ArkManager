@extends('layouts.user')

@if(isset($line))
    @section('title', 'Editing Breeding Line - ' . $dino->name)
@else
    @section('title', 'New Breeding Line - ' . $dino->name)
@endif

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-9">
            @if(isset($line))
                {{ Form::model($line, ['route' => 'dino.line.update', 'method' => 'PUT']) }}
                <input type="hidden" name="line_slug" value="{{ $line->slug }}">
            @else
                {{ Form::open(['route' => 'dino.line.store', 'method' => 'POST']) }}
            @endif
                <input type="hidden" name="dino_ark_id" value="{{ $dino->ark_id }}">

            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <label for="mutation_type">Mutation Type</label>
                    {{ Form::select('mutation_type', $mutationTypes, null, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-6">
                    <label for="base_level">Base Dino Level</label>
                    {{ Form::number('base_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
                </div>
            </div>

            @if($user->tribe->use_true_values)
                @include('dino.line.partials.trueValuesFields')
            @endif

            @if($user->tribe->use_stat_levels)
                @include('dino.line.partials.statLevelsFields')
            @endif

            <div class="row justify-content-center mt-3">
                <div class="col-sm-6">
                    @if(isset($line))
                        <button class="btn btn-info btn-block" type="submit"><i class="far fa-save"></i> Save {{ $line->dino->name }} Line</button>
                    @else
                        <button class="btn btn-success btn-block" type="submit">Create New Breeding Line</button>
                    @endif
                </div>
            </div>

            {{ Form::close() }}
        </div>
        <div class="col-sm-3">

            <div class="card">
                <img class="card-img-top bg-white dino-icon-card" src="{{ $dino->image_public_path }}" alt="{{ $dino->name }} Icon">
                <div class="card-body">
                    <h5 class="card-title">{{ $dino->name }} Technical Info</h5>
                    @if($dino->description)
                        <p class="card-text">{{ $dino->description }}</p>
                    @else
                        <p class="card-text">No Description Found For {{ $dino->name }}</p>
                    @endif
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $dino->ark_id }}</li>
                    @if($dino->is_dlc)
                        <li class="list-group-item">
                            <span class="badge badge-pill badge-info">
                                {{ $dino->dlc_name }}
                            </span>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>

@endsection
