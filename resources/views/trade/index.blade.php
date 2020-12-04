@extends('layouts.user')

@section('title', 'Trade Hub - Current Listings')

@section('content')

    @if($trades->count() != 0)
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <table class="table table-sm table-hover table-borderless text-center">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Item Being Sold</th>
                        <th scope="col">Blueprint</th>
                        <th scope="col">Payment Item</th>
                        <th scope="col">User</th>
                        <th scope="col">Accepts Barters</th>
                        <th scope="col">Offer Expires</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trades as $trade)
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
                            <td>{{ $trade->user->fullusername }}</td>
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
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                {{ $trades->links() }}
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-sm-12 text-center">
                <p class="lead text-info">No active trades available. Check back later for new trades.</p>
            </div>
        </div>
    @endif

@endsection
