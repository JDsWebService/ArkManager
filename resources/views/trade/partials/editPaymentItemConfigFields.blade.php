<!-- Item ID -->
<input type="hidden" name="payment_item" value="{{ $trade->paymentItem->id }}">
<!-- End Item ID -->

<!-- Item Quantity -->
<label for="payment_quantity" class="mt-3">Quantity</label>
{{ Form::number('payment_quantity', null, ['class' => 'form-control', 'placeholder' => '1']) }}
<!-- End Item Quantity -->

<!-- Item Quality -->
@if($trade->paymentHasQuality)
    <label for="payment_quality" class="mt-3">Does Item Have Quality?</label>
    {{ Form::select('payment_quality', $itemQualities, null, ['class' => 'form-control']) }}
@endif
<!-- End Item Quality -->

<!-- Item Armor -->
@if($trade->paymentHasArmor)
    <label for="payment_armor" class="mt-3">Armor</label>
    {{ Form::number('payment_armor', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
@endif
<!-- End Item Armor -->

@if($trade->paymentHasTemperature)
    <!-- Item Hypothermic -->
    <label for="payment_hypothermic" class="mt-3">Hypothermic Resistance</label>
    {{ Form::number('payment_hypothermic', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
    <!-- End Item Hypothermic -->

    <!-- Item Hyperthermic -->
    <label for="payment_hyperthermic" class="mt-3">Hyperthermic Resistance</label>
    {{ Form::number('payment_hyperthermic', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
    <!-- End Item Hyperthermic -->
@endif

<!-- Item Damage -->
@if($trade->paymentHasDamage)
    <label for="payment_damage" class="mt-3">Damage</label>
    {{ Form::number('payment_damage', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
@endif
<!-- End Item Damage -->

<!-- Item Durability -->
@if($trade->paymentHasDurability)
    <label for="payment_durability" class="mt-3">Durability</label>
    {{ Form::number('payment_durability', null, ['class' => 'form-control', 'step' => '.1', 'placeholder' => '1']) }}
@endif
<!-- End Item Durability -->

<!-- Item Blueprint -->
<div class="row form-group mt-3">
    <label for="payment_blueprint" class="col-sm-10 col-form-label">Is item a blueprint?</label>
    <div class="col-sm-2">
        <label class="switch s-icons s-outline s-outline-primary mr-2">
            <input type="hidden" name="payment_blueprint" value="0">
            {{ Form::checkbox('payment_blueprint', '1', $trade->payment_blueprint) }}
            <span class="slider round"></span>
        </label>
    </div>
</div>
<!-- End Item Blueprint -->
