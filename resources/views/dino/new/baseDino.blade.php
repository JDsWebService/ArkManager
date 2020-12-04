@extends('layouts.user')

@section('title', 'New Base Dino')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ Form::open(['route' => 'dino.store.base', 'method' => 'POST']) }}

            <div class="row">
                <div class="col-sm-4">
                    <label for="dino_meta_info_id">Dino Breed</label>
                    <select name="dino_meta_info_id" class="form-control">
                        @foreach($dinoMetaData as $dino)
                            <option value="{{ $dino->id }}">
                                {{ $dino->name }}
                                @if($dino->is_dlc)
                                    ({{ $dino->dlc_name }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="mutation_type">Mutation Type</label>
                    <select name="mutation_type" class="form-control">
                        <option value="health">Health</option>
                        <option value="stamina">Stamina</option>
                        <option value="oxygen">Oxygen</option>
                        <option value="food">Food</option>
                        <option value="weight">Weight</option>
                        <option value="damage">Damage</option>
                        <option value="movement">Movement Speed</option>
                        <option value="crafting">Crafting Skill</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="level">Current Level</label>
                    {{ Form::number('level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
                </div>
            </div>
            <hr>
            <div class="row justify-content-center mt-3">
                <div class="col-sm-12">
                    <p class="text-muted font-italic">Note: All values for stats should be their true values and not their stat levels. You can find this information on the dino's inventory screen. <span class="text-info font-italic">All values are optional except for the mutation type that you are tracking.</span></p>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-sm-3">
                    <label for="health">Health</label>
                    {{ Form::number('health', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="stamina">Stamina</label>
                    {{ Form::number('stamina', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="oxygen">Oxygen</label>
                    {{ Form::number('oxygen', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="food">Food</label>
                    {{ Form::number('food', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-sm-3">
                    <label for="weight">Weight</label>
                    {{ Form::number('weight', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="damage">Melee Damage</label>
                    {{ Form::number('damage', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="movement">Movement Speed</label>
                    {{ Form::number('movement', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="crafting">Crafting Skill</label>
                    {{ Form::number('crafting', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-sm-3">
                    <label for="torpidity">Torpidity</label>
                    {{ Form::number('torpidity', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="water">Water</label>
                    {{ Form::number('water', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="temperature">Temperature</label>
                    {{ Form::number('temperature', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
                </div>
                <div class="col-sm-3">
                    <label for="fortitude">Fortitude</label>
                    {{ Form::number('fortitude', null, ['class' => 'form-control', 'placeholder' => 1234.5, 'step' => ".1"]) }}
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
