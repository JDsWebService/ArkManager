<hr>
<h4>Stat Levels</h4>
<p>This section is for stat levels. This is post-tame stat levels. You will need a mod such as Super Awesome Spyglass in order to see these levels.</p>

<div class="row justify-content-center">
    <div class="col-sm-6">
        <label for="base_health_stat_level">Base Health</label>
        {{ Form::number('base_health_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_stamina_stat_level">Base Stamina</label>
        {{ Form::number('base_stamina_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-sm-6">
        <label for="base_oxygen_stat_level">Base Oxygen (Optional)</label>
        {{ Form::number('base_oxygen_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_food_stat_level">Base Food</label>
        {{ Form::number('base_food_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-sm-6">
        <label for="base_weight_stat_level">Base Weight</label>
        {{ Form::number('base_weight_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_damage_stat_level">Base Damage</label>
        {{ Form::number('base_damage_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-sm-6">
        <label for="base_movement_stat_level">Base Movement Speed (Optional)</label>
        {{ Form::number('base_movement_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_torpidity_stat_level">Base Torpidity (Optional)</label>
        {{ Form::number('base_torpidity_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-sm-6">
        <label for="base_fortitude_stat_level">Base Fortitude (Optional)</label>
        {{ Form::number('base_fortitude_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
    <div class="col-sm-6">
        <label for="base_crafting_stat_level">Base Crafting Skill (Optional)</label>
        {{ Form::number('base_crafting_stat_level', null, ['class' => 'form-control', 'placeholder' => 1]) }}
    </div>
</div>
