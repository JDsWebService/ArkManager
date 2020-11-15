@extends('layouts.user')

@section('title', 'New Breeding Line')

@section('content')

    <div class="callout callout-warning">
        <h4>A note about this tool...</h4>
        <p>When breeding dinos in Ark: Survival Evolved, we suggest that you get two dinos (one male, one female) that have the exact same stats. This is crucial in order for this tool to work, as it will only keep track of the dino from the base stats. If you don't have dinos that have the same stats, this tool will not work for you. Get the male and female to have the same stats and then come back and input the base stats then.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-6">
            {{ Form::open(['route' => 'dino.line.typeselection', 'method' => 'POST']) }}

            <label for="ark_id">What type of Dino does this line have?</label>
            <select name="ark_id" id="ark_id" class="form-control">
                @foreach($dinos as $dino)
                    <option value="{{ $dino->ark_id }}">
                        {{ $dino->name }}
                        @if($dino->is_dlc)
                            - ({{ $dino->dlc_name }} DLC)
                        @endif
                    </option>
                @endforeach
            </select>

            <button class="btn btn-block btn-success mt-3" type="submit">Start New Line</button>

            {{ Form::close() }}
        </div>
    </div>

@endsection
