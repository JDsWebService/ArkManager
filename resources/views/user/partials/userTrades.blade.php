<h5>{{ $user->username }}'s Active Trades</h5>
<hr>
@if($user->trades->count() != 0)
    <table class="table table-hover table-borderless text-center">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Item Being Sold</th>
            <th scope="col">Blueprint</th>
            <th scope="col">Payment Item</th>
            <th scope="col">Accepts Barters</th>
            <th scope="col">Offer Expires</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->trades as $trade)
            <tr>
                <td>
                    <img src="{{ $trade->soldItem->image_public_path }}" style="width: 35px; height 35px;" alt="{{ $trade->soldItem->name }} Icon">
                </td>
                <td>
                    @if($trade->sold_quality)
                        @switch($trade->sold_quality)
                            @case("primitive")
                            <span class="text-muted">{{ $trade->soldItem->name }}</span>
                            @break
                            @case("ramshackle")
                            <span class="text-success">{{ $trade->soldItem->name }}</span>
                            @break
                            @case("apprentice")
                            <span class="text-primary">{{ $trade->soldItem->name }}</span>
                            @break
                            @case("journeyman")
                            <span class="text-secondary">{{ $trade->soldItem->name }}</span>
                            @break
                            @case("mastercraft")
                            <span class="text-warning">{{ $trade->soldItem->name }}</span>
                            @break
                            @case("ascendant")
                            <span class="text-info">{{ $trade->soldItem->name }}</span>
                            @break
                            @default
                            <span class="text-white">{{ $trade->soldItem->name }}</span>
                            @break
                        @endswitch
                    @else
                        <span class="text-white">{{ $trade->soldItem->name }}</span>
                    @endif
                </td>
                <td>
                    @if($trade->sold_blueprint)
                        <span class="text-success">True</span>
                    @else
                        <span class="text-danger">False</span>
                    @endif
                </td>
                <td>{{ $trade->paymentItem->name }}</td>
                <td>
                    @if($trade->bartering_allowed)
                        <span class="text-success">True</span>
                    @else
                        <span class="text-danger">False</span>
                    @endif
                </td>
                <td>{{ $trade->timeRemaining }}</td>
                <td>
                    <a href="{{ route('trade.view', $trade->uuid) }}" class="btn btn-primary">
                        View
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $user->trades->links() }}
@else
    <div class="row justify-content-center">
        <div class="col-sm-12 text-center">
            <p class="text-info">{{ $user->username }} does not have any other active trades available right now.</p>
        </div>
    </div>
@endif
