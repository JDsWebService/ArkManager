@extends('layouts.user')

@section('title', "Editing Base Dino - {$baseDino->metaInfo->name} (Lvl {$baseDino->level}) {$baseDino->mutation_type} Stats")

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ Form::open(['route' => ['dino.update.base', $baseDino->slug], 'method' => 'PUT']) }}

            <div class="row">
                <div class="col-sm-6">
                    <label for="mutation_type">Mutation Type</label>
                    <select class="form-control mb-3" name="mutation_type" readonly>
                        <option value="{{ $baseDino->getRawOriginal('mutation_type') }}">{{ $baseDino->mutation_type }}</option>
                    </select>
                    <p class="text-info font-italic">Note: This field is disabled, create a new base dino instead.</p>
                </div>
                <div class="col-sm-6">
                    <label for="level">Current Level</label>
                    {{ Form::number('level', $baseDino->level, ['class' => 'form-control', 'placeholder' => 1, 'autofocus']) }}
                </div>
            </div>
            <hr>
            <div class="row justify-content-center mt-3">
                <div class="col-sm-12">
                    <p class="text-muted font-italic">Note: All values for stats should be their true values and not their stat levels. You can find this information on the dino's inventory screen. All values are optional except for the mutation type that you are tracking.</p>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-sm-3">
                    <label for="health">Health</label>
                    {{ Form::number('health', $baseDino->health, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="stamina">Stamina</label>
                    {{ Form::number('stamina', $baseDino->stamina, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="oxygen">Oxygen</label>
                    {{ Form::number('oxygen', $baseDino->oxygen, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="food">Food</label>
                    {{ Form::number('food', $baseDino->food, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-sm-3">
                    <label for="weight">Weight</label>
                    {{ Form::number('weight', $baseDino->weight, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="damage">Melee Damage</label>
                    {{ Form::number('damage', $baseDino->damage, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="movement">Movement Speed</label>
                    {{ Form::number('movement', $baseDino->movement, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="crafting">Crafting Skill</label>
                    {{ Form::number('crafting', $baseDino->crafting, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-sm-3">
                    <label for="torpidity">Torpidity</label>
                    {{ Form::number('torpidity', $baseDino->torpidity, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="water">Water</label>
                    {{ Form::number('water', $baseDino->water, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="temperature">Temperature</label>
                    {{ Form::number('temperature', $baseDino->temperature, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="fortitude">Fortitude</label>
                    {{ Form::number('fortitude', $baseDino->fortitude, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-block" type="submit">
                        Save Base Dino To Database
                    </button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
