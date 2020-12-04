

<!-- Item ID -->
<input type="hidden" name="sold_item" value="{{ $item->id }}">
<!-- End Item ID -->

<!-- Item Quantity -->
<label for="sold_quantity" class="mt-3">Quantity</label>
<input type="number" class="form-control" name="sold_quantity" placeholder="1">
<!-- End Item Quantity -->

<!-- Item Quality -->
@if($item->hasQuality)
    <label for="sold_quality" class="mt-3">Does Item Have Quality?</label>
    <select name="sold_quality" class="form-control">
        @foreach($itemQualities as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
@endif
<!-- End Item Quality -->

<!-- Item Armor -->
@if($item->hasArmor)
    <label for="sold_armor" class="mt-3">Armor</label>
    <input type="number" step=".1" class="form-control" name="sold_armor" placeholder="1">
@endif
<!-- End Item Armor -->

@if($item->hasTemperature)
    <!-- Item Hypothermic -->
    <label for="sold_hypothermic" class="mt-3">Hypothermic Resistance</label>
    <input type="number" step=".1" class="form-control" name="sold_hypothermic" placeholder="1">
    <!-- End Item Hypothermic -->

    <!-- Item Hyperthermic -->
    <label for="sold_hyperthermic" class="mt-3">Hyperthermic Resistance</label>
    <input type="number" step=".1" class="form-control" name="sold_hyperthermic" placeholder="1">
    <!-- End Item Hyperthermic -->
@endif

<!-- Item Damage -->
@if($item->hasDamage)
    <label for="sold_damage" class="mt-3">Damage</label>
    <input type="number" step=".1" class="form-control" name="sold_damage" placeholder="1">
@endif
<!-- End Item Damage -->

<!-- Item Durability -->
@if($item->hasDurability)
    <label for="sold_durability" class="mt-3">Durability</label>
    <input type="number" step="1" class="form-control" name="sold_durability" placeholder="1">
@endif
<!-- End Item Durability -->

<!-- Item Blueprint -->
@if($item->hasBlueprint)
    <div class="row form-group mt-3">
        <label for="sold_blueprint" class="col-sm-10 col-form-label">Is item a blueprint?</label>
        <div class="col-sm-2">
            <label class="switch s-icons s-outline s-outline-primary mr-2">
                <input type="hidden" name="sold_blueprint" value="0">
                <input type="checkbox" name="sold_blueprint" value="1">
                <span class="slider round"></span>
            </label>
        </div>
    </div>
@endif
<!-- End Item Blueprint -->
