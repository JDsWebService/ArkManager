<hr>
<h4>True Values</h4>
<p>In this section fill out the true values of the dinos stats. These values should come from the dino information screen in-game when opening the dinos inventory.</p>

<div class="row justify-content-center">
    <div class="col-sm-6">
        <label for="base_health_true_value">Base Health</label>
        {{ Form::number('base_health_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_stamina_true_value">Base Stamina</label>
        {{ Form::number('base_stamina_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-sm-6">
        <label for="base_oxygen_true_value">Base Oxygen (Optional)</label>
        {{ Form::number('base_oxygen_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_food_true_value">Base Food</label>
        {{ Form::number('base_food_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-sm-6">
        <label for="base_weight_true_value">Base Weight</label>
        {{ Form::number('base_weight_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_damage_true_value">Base Damage</label>
        {{ Form::number('base_damage_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-sm-6">
        <label for="base_movement_true_value">Base Movement Speed (Optional)</label>
        {{ Form::number('base_movement_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_torpidity_true_value">Base Torpidity (Optional)</label>
        {{ Form::number('base_torpidity_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-sm-6">
        <label for="base_fortitude_true_value">Base Fortitude (Optional)</label>
        {{ Form::number('base_fortitude_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_crafting_true_value">Base Crafting Skill (Optional)</label>
        {{ Form::number('base_crafting_true_value', null, ['class' => 'form-control', 'placeholder' => 1000.1]) }}
    </div>
</div>
