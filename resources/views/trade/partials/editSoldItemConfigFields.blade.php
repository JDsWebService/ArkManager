<!-- Item ID -->
<input type="hidden" name="sold_item" value="{{ $trade->soldItem->id }}">
<!-- End Item ID -->

<!-- Item Quantity -->
<label for="sold_quantity" class="mt-3">Quantity</label>
{{ Form::number('sold_quantity', null, ['class' => 'form-control', 'placeholder' => '1']) }}
<!-- End Item Quantity -->

<!-- Item Quality -->
@if($trade->soldItem->hasQuality)
    <label for="sold_quality" class="mt-3">Does Item Have Quality?</label>
    {{ Form::select('sold_quality', $itemQualities, null, ['class' => 'form-control']) }}
@endif
<!-- End Item Quality -->

<!-- Item Armor -->
@if($trade->soldItem->hasArmor)
    <label for="sold_armor" class="mt-3">Armor</label>
    {{ Form::number('sold_armor', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
@endif
<!-- End Item Armor -->

@if($trade->soldItem->hasTemperature)
    <!-- Item Hypothermic -->
    <label for="sold_hypothermic" class="mt-3">Hypothermic Resistance</label>
    {{ Form::number('sold_hypothermic', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
    <!-- End Item Hypothermic -->

    <!-- Item Hyperthermic -->
    <label for="sold_hyperthermic" class="mt-3">Hyperthermic Resistance</label>
    {{ Form::number('sold_hyperthermic', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
    <!-- End Item Hyperthermic -->
@endif

<!-- Item Damage -->
@if($trade->soldItem->hasDamage)
    <label for="sold_damage" class="mt-3">Damage</label>
    {{ Form::number('sold_damage', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
@endif
<!-- End Item Damage -->

<!-- Item Durability -->
@if($trade->soldItem->hasDurability)
    <label for="sold_durability" class="mt-3">Durability</label>
    {{ Form::number('sold_durability', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
@endif
<!-- End Item Durability -->

@if($trade->soldItem->hasBlueprint)
<!-- Item Blueprint -->
    <div class="row form-group mt-3">
    <label for="sold_blueprint" class="col-sm-10 col-form-label">Is item a blueprint?</label>
    <div class="col-sm-2">
        <label class="switch s-icons s-outline s-outline-primary mr-2">
            <input type="hidden" name="sold_blueprint" value="0">
            {{ Form::checkbox('sold_blueprint', '1', $trade->sold_blueprint) }}
            <span class="slider round"></span>
        </label>
    </div>
</div>
<!-- End Item Blueprint -->
@endif
