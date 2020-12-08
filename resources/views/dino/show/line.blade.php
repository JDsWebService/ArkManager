@extends('layouts.user')

@section('title', "{$baseDino->metaInfo->name} (Base Lvl {$baseDino->level}) {$baseDino->mutation_type} Line")

@section('content')

    <div class="row justify-content-center mb-3">
        <div class="col-sm-3">
            <a href="{{ route('dino.new.mutation', $baseDino->uuid) }}" class="btn btn-block btn-success">
                <i class="far fa-plus-square"></i> Add Mutated Dino
            </a>
        </div>
        <div class="col-sm-3">
            <a href="{{ route('dino.edit.base', $baseDino->slug) }}" class="btn btn-block btn-primary">
                <i class="far fa-edit"></i> Edit Base Dino Stats
            </a>
        </div>
        <div class="col-sm-3">
            <!-- Delete Button Modal Trigger -->
            <button class="btn btn-block btn-danger" data-toggle="modal" data-target="#deleteLineModal">
                <i class="far fa-trash-alt"></i> Delete Base Dino
            </button>
            @include('dino.partials.deleteLineModal', ['baseDinoModal' => $baseDino])
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-3">
            @include('dino.partials.metaInfoCard', ['metaInfo' => $baseDino->metaInfo])
        </div>
        <div class="col-sm-3">
            <h4>Base Dino Stats</h4>
            @include('dino.partials.dinoStatsTable', ['dino' => $baseDino])
            @if($omittedStats)
                <p class="text-info font-italic">Note: Some stats that have a value of 0 are omitted. Edit base dino stats to add their values.</p>
            @endif
        </div>
        <div class="col-sm-6">
            <h4>Mutated Dinos</h4>
            @if($mutatedDinos->count() != 0)
                @include('dino.partials.mutatedDinosTable', ['mutatedDinos' => $mutatedDinos])
            @else
                <p class="text-warning">No mutated dinos have been added to this line.</p>
            @endif
        </div>
    </div>

@endsection
