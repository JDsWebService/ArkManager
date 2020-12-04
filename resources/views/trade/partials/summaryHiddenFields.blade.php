<!-- Sold Item -->
<input type="hidden" name="sold_item" value="{{ $request->sold_item }}">
<input type="hidden" name="sold_quantity" value="{{ $request->sold_quantity }}">
@if(isset($request->sold_quality))
    <input type="hidden" name="sold_quality" value="{{ $request->sold_quality }}">
@endif
@if(isset($request->sold_armor))
    <input type="hidden" name="sold_armor" value="{{ $request->sold_armor }}">
@endif
@if(isset($request->sold_hypothermic))
    <input type="hidden" name="sold_hypothermic" value="{{ $request->sold_hypothermic }}">
@endif
@if(isset($request->sold_hyperthermic))
    <input type="hidden" name="sold_hyperthermic" value="{{ $request->sold_hyperthermic }}">
@endif
@if(isset($request->sold_damage))
    <input type="hidden" name="sold_damage" value="{{ $request->sold_damage }}">
@endif
@if(isset($request->sold_durability))
    <input type="hidden" name="sold_durability" value="{{ $request->sold_durability }}">
@endif
@if(isset($request->sold_blueprint) && $request->sold_blueprint == '1')
    <input type="hidden" name="sold_blueprint" value="1">
@else
    <input type="hidden" name="sold_blueprint" value="0">
@endif
<!-- Payment Item -->
<input type="hidden" name="payment_item" value="{{ $request->payment_item }}">
<input type="hidden" name="payment_quantity" value="{{ $request->payment_quantity }}">
@if(isset($request->payment_quality))
    <input type="hidden" name="payment_quality" value="{{ $request->payment_quality }}">
@endif
@if(isset($request->payment_armor))
    <input type="hidden" name="payment_armor" value="{{ $request->payment_armor }}">
@endif
@if(isset($request->payment_hypothermic))
    <input type="hidden" name="payment_hypothermic" value="{{ $request->payment_hypothermic }}">
@endif
@if(isset($request->payment_hyperthermic))
    <input type="hidden" name="payment_hyperthermic" value="{{ $request->payment_hyperthermic }}">
@endif
@if(isset($request->payment_damage))
    <input type="hidden" name="payment_damage" value="{{ $request->payment_damage }}">
@endif
@if(isset($request->payment_durability))
    <input type="hidden" name="payment_durability" value="{{ $request->payment_durability }}">
@endif
@if(isset($request->payment_blueprint) && $request->payment_blueprint == '1')
    <input type="hidden" name="payment_blueprint" value="1">
@else
    <input type="hidden" name="payment_blueprint" value="0">
@endif
