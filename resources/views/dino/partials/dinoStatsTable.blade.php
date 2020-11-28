<dl class="row justify-content-center">
    @if($dino->health != 0)
        <dt class="col-sm-6">Health</dt>
        <dd class="col-sm-6">{{ $dino->health }}</dd>
    @endif

    @if($dino->stamina != 0)
        <dt class="col-sm-6">Stamina</dt>
        <dd class="col-sm-6">{{ $dino->stamina }}</dd>
    @endif

    @if($dino->torpidity != 0)
        <dt class="col-sm-6">Torpidity</dt>
        <dd class="col-sm-6">{{ $dino->torpidity }}</dd>
    @endif

    @if($dino->oxygen != 0)
        <dt class="col-sm-6">Oxygen</dt>
        <dd class="col-sm-6">{{ $dino->oxygen }}</dd>
    @endif

    @if($dino->food != 0)
        <dt class="col-sm-6">Food</dt>
        <dd class="col-sm-6">{{ $dino->food }}</dd>
    @endif

    @if($dino->water != 0)
        <dt class="col-sm-6">Water</dt>
        <dd class="col-sm-6">{{ $dino->water }}</dd>
    @endif

    @if($dino->temperature != 0)
        <dt class="col-sm-6">Temperature</dt>
        <dd class="col-sm-6">{{ $dino->temperature }}</dd>
    @endif

    @if($dino->weight != 0)
        <dt class="col-sm-6">Weight</dt>
        <dd class="col-sm-6">{{ $dino->weight }}</dd>
    @endif

    @if($dino->damage != 0)
        <dt class="col-sm-6">Melee Damage</dt>
        <dd class="col-sm-6">{{ $dino->damage }}%</dd>
    @endif

    @if($dino->movement != 0)
        <dt class="col-sm-6">Movement</dt>
        <dd class="col-sm-6">{{ $dino->movement }}%</dd>
    @endif

    @if($dino->fortitude != 0)
        <dt class="col-sm-6">Fortitude</dt>
        <dd class="col-sm-6">{{ $dino->fortitude }}</dd>
    @endif

    @if($dino->crafting != 0)
        <dt class="col-sm-6">Crafting Skill</dt>
        <dd class="col-sm-6">{{ $dino->crafting }}%</dd>
    @endif
</dl>
