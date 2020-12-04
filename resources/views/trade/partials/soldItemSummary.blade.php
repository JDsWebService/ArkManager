<div class="row justify-content-center">
    <div class="col-sm-12">
        <h5>Selling {{ $item->name }}</h5>
    </div>
    <div class="col-sm-4 text-center">
        <img src="{{ $item->image_public_path }}" style="width: 120px; height 120px;" alt="{{ $item->name }} Icon">
    </div>
    <div class="col-sm-8 trade-item-summary">
        <table class="table table-borderless table-sm bg-transparent">
            <!-- Item Quantity -->
            <tr>
                <th class="text-white">Quantity:</th>
                <td class="text-center">{{ $request->sold_quantity }}</td>
            </tr>
            <!-- End Item Quantity -->

            <!-- Item Quality -->
            @if($soldItem->hasQuality)
            <tr>
                <th class="text-white">Quality:</th>
                <td class="text-center">
                    @switch($request->sold_quality)
                        @case("primitive")
                        <span class="text-muted">Primitive</span>
                        @break
                        @case("ramshackle")
                        <span class="text-success">Ramshackle</span>
                        @break
                        @case("apprentice")
                        <span class="text-primary">Apprentice</span>
                        @break
                        @case("journeyman")
                        <span class="text-secondary">Journeyman</span>
                        @break
                        @case("mastercraft")
                        <span class="text-warning">Mastercraft</span>
                        @break
                        @case("ascendant")
                        <span class="text-info">Ascendant</span>
                        @break
                    @endswitch
                </td>
            </tr>
            @endif
            <!-- End Item Quality -->

            <!-- Item Armor -->
            @if($item->hasArmor)
                <tr>
                    <th class="text-white">Armor:</th>
                    <td class="text-center">
                        {{ $request->sold_armor }}
                    </td>
                </tr>
            @endif
            <!-- Send Item Armor -->

            @if($item->hasTemperature)
                <!-- Item Hypothermic -->
                <tr>
                    <th class="text-white">Hypothermic Resistance:</th>
                    <td class="text-center">{{ $request->sold_hypothermic }}</td>
                </tr>
                <!-- End Item Hypothermic -->

                <!-- Item Hyperthermic -->
                <tr>
                    <th class="text-white">Hyperthermic Resistance:</th>
                    <td class="text-center">{{ $request->sold_hyperthermic }}</td>
                </tr>
                <!-- End Item Hyperthermic -->
            @endif

            <!-- Item Damage -->
            @if($item->hasDamage)
                <tr>
                    <th class="text-white">Damage: </th>
                    <td class="text-center">{{ $request->sold_damage }}%</td>
                </tr>
            @endif
            <!-- End Item Damage -->

            <!-- Item Durability -->
            @if($item->hasDurability)
                <tr>
                    <th class="text-white">Durability</th>
                    <td class="text-center">{{ $request->sold_durability }}</td>
                </tr>
            @endif
            <!-- End Item Durability -->

            <!-- Item Blueprint -->
            @if($item->hasBlueprint)
                <tr>
                    <th class="text-white">Is Item A Blueprint?
                    <td class="text-center">
                        @if($request->sold_blueprint == '1')
                            <span class="text-success">True</span>
                        @else
                            <span class="text-danger">False</span>
                        @endif
                    </td>
                </tr>
            @endif
            <!-- End Item Blueprint -->

        </table>
    </div>
</div>
