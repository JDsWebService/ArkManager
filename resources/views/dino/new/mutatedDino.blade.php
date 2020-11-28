@extends('layouts.user')

@section('title', "Add Mutation to {$baseDino->metaInfo->name} (Base Lvl {$baseDino->level}) {$baseDino->mutation_type} Line")

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ Form::open(['route' => ['dino.store.mutation', $baseDino->uuid], 'method' => 'POST']) }}

            <div class="row">
                <div class="col-sm-6">
                    <label for="mutation_type">Mutation Type</label>
                    <select class="form-control mb-3" name="mutation_type" readonly>
                        <option value="{{ $baseDino->getRawOriginal('mutation_type') }}">{{ $baseDino->mutation_type }}</option>
                    </select>
                    <p class="text-info font-italic">Note: This field is disabled, create a new base dino instead.</p>
                </div>
                <div class="col-sm-6">
                    <label for="level">Current Dino's Level</label>
                    {{ Form::number('level', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Level ({$newestDino->level})", 'autofocus']) }}
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <p class="text-muted font-italic">Note: All values for stats should be their true values and not their stat levels. You can find this information on the dino's inventory screen. All values are optional except for the mutation type that you are tracking.</p>
                </div>
            </div>
            <div class="row justify-content-center">
                @if($baseDino->health != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="health">Health</label>
                        {{ Form::number('health', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->health})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->stamina != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="stamina">Stamina</label>
                        {{ Form::number('stamina', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->stamina})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->oxygen != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="oxygen">Oxygen</label>
                        {{ Form::number('oxygen', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->oxygen})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->food != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="food">Food</label>
                        {{ Form::number('food', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->food})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->weight != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="weight">Weight</label>
                        {{ Form::number('weight', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->weight})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->damage != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="damage">Melee Damage</label>
                        {{ Form::number('damage', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->damage})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->movement != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="movement">Movement Speed</label>
                        {{ Form::number('movement', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->movement})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->crafting != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="crafting">Crafting Skill</label>
                        {{ Form::number('crafting', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->crafting})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->torpidity != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="torpidity">Torpidity</label>
                        {{ Form::number('torpidity', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->torpidity})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->water != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="water">Water</label>
                        {{ Form::number('water', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->water})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->temperature != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="temperature">Temperature</label>
                        {{ Form::number('temperature', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->temperature})", 'step' => ".1"]) }}
                    </div>
                @endif
                @if($baseDino->fortitude != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="fortitude">Fortitude</label>
                        {{ Form::number('fortitude', null, ['class' => 'form-control', 'placeholder' => "Previous Dino Stat Value ({$newestDino->fortitude})", 'step' => ".1"]) }}
                    </div>
                @endif
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-block" type="submit">
                        Save Mutated Dino To Database
                    </button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
