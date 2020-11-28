@extends('layouts.user')

@section('title', "Edit Mutation on {$baseDino->metaInfo->name} (Base Lvl {$baseDino->level}) {$baseDino->mutation_type} Line")

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ Form::open(['route' => ['dino.update.mutation', $mutatedDino->slug], 'method' => 'PUT']) }}

            <div class="row">
                <div class="col-sm-12">
                    <div class="callout callout-warning">
                        <h4>Heads Up!</h4>
                        <p>You are editing a mutated dino. This form is subject to strict validation rules. The placeholders in the form fields below are from both the previous dino, the current dino you are editing, and the newest dino in the breeding line, if one exists. <strong class="text-danger">ONLY UPDATE THE INCORRECT VALUES! LEAVE EVERYTHING ELSE BLANK!</strong>
                        </p>
                        <p>
                            <strong>The following formats will apply to the form field placeholders below:</strong>
                            <br>
                            If there is a previous dino <strong class="text-danger">AND</strong> a newer dino:
                            <span class="text-info">(Previous Dino Stat Value)</span> |
                            <span class="text-success">(This Mutated Dino Stat Value)</span> |
                            <span class="text-warning">(Newest Dino Stat Value)</span>
                            <br>
                            If this dino you're editing is the <strong class="text-danger">MOST RECENT ADDITION</strong>:
                            <span class="text-info">(Previous Dino Stat Value)</span> |
                            <span class="text-success">(This Mutated Dino Stat Value)</span>
                        </p>
                        <p>
                            If all of this is confusing to you and you do not understand, its a safer idea to just delete the incorrect mutated dino from the line and re-enter the values.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label for="mutation_type">Mutation Type</label>
                    <select class="form-control mb-3" name="mutation_type" readonly>
                        <option value="{{ $baseDino->getRawOriginal('mutation_type') }}">{{ $baseDino->mutation_type }}</option>
                    </select>
                    <p class="text-info font-italic">Note: This field is disabled, create a new base dino instead.</p>
                </div>
                <div class="col-sm-6">
                    <label for="level">Dino Level</label>
                    @if($newestDino)
                        {{ Form::number('level', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->level} | {$mutatedDino->level} | {$newestDino->level}"]) }}
                    @else
                        {{ Form::number('level', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->level} | {$mutatedDino->level}"]) }}
                    @endif
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
                        @if($newestDino)
                            {{ Form::number('health', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->health} | {$mutatedDino->health} | {$newestDino->health}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('health', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->health} | {$mutatedDino->health}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->stamina != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="stamina">Stamina</label>
                        @if($newestDino)
                            {{ Form::number('stamina', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->stamina} | {$mutatedDino->stamina} | {$newestDino->stamina}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('stamina', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->stamina} | {$mutatedDino->stamina}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->oxygen != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="oxygen">Oxygen</label>
                        @if($newestDino)
                            {{ Form::number('oxygen', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->oxygen} | {$mutatedDino->oxygen} | {$newestDino->oxygen}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('oxygen', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->oxygen} | {$mutatedDino->oxygen}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->food != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="food">Food</label>
                        @if($newestDino)
                            {{ Form::number('food', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->food} | {$mutatedDino->food} | {$newestDino->food}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('food', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->food} | {$mutatedDino->food}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->weight != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="weight">Weight</label>
                        @if($newestDino)
                            {{ Form::number('weight', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->weight} | {$mutatedDino->weight} | {$newestDino->weight}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('weight', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->weight} | {$mutatedDino->weight}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->damage != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="damage">Melee Damage</label>
                        @if($newestDino)
                            {{ Form::number('damage', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->damage} | {$mutatedDino->damage} | {$newestDino->damage}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('damage', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->damage} | {$mutatedDino->damage}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->movement != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="movement">Movement Speed</label>
                        @if($newestDino)
                            {{ Form::number('movement', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->movement} | {$mutatedDino->movement} | {$newestDino->movement}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('movement', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->movement} | {$mutatedDino->movement}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->crafting != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="crafting">Crafting Skill</label>
                        @if($newestDino)
                            {{ Form::number('crafting', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->crafting} | {$mutatedDino->crafting} | {$newestDino->crafting}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('crafting', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->crafting} | {$mutatedDino->crafting}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->torpidity != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="torpidity">Torpidity</label>
                        @if($newestDino)
                            {{ Form::number('torpidity', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->torpidity} | {$mutatedDino->torpidity} | {$newestDino->torpidity}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('torpidity', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->torpidity} | {$mutatedDino->torpidity}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->water != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="water">Water</label>
                        @if($newestDino)
                            {{ Form::number('water', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->water} | {$mutatedDino->water} | {$newestDino->water}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('water', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->water} | {$mutatedDino->water}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->temperature != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="temperature">Temperature</label>
                        @if($newestDino)
                            {{ Form::number('temperature', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->temperature} | {$mutatedDino->temperature} | {$newestDino->temperature}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('temperature', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->temperature} | {$mutatedDino->temperature}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
                @if($baseDino->fortitude != 0)
                    <div class="col-sm-3 mt-3">
                        <label for="fortitude">Fortitude</label>
                        @if($newestDino)
                            {{ Form::number('fortitude', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->fortitude} | {$mutatedDino->fortitude} | {$newestDino->fortitude}", 'step' => ".1"]) }}
                        @else
                            {{ Form::number('fortitude', null, ['class' => 'form-control', 'placeholder' => "{$previousDino->fortitude} | {$mutatedDino->fortitude}", 'step' => ".1"]) }}
                        @endif
                    </div>
                @endif
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
