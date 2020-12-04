@extends('layouts.user')

@section('title', 'Viewing Trade For ' . $trade->soldItem->name)

@section('content')

    @if($trade->isUserTradeOwner)
        <div class="row justify-content-center mb-3">
            <div class="col-sm-12">
                <h4>Trade Owner Actions</h4>
                <hr>
                <p class="lead">
                    <span class="text-success">User ID: {{ Auth::user()->id }}</span>
                    <span class="text-success">Trade User ID: {{ $trade->user_id }}</span>
                </p>
                <div class="row justify-content-center">
                    <div class="col-sm-3">
                        <a href="{{ route('trade.edit.trade', $trade->uuid) }}" class="btn btn-info btn-block btn-sm">
                            <i class="fas fa-edit"></i> Edit Trade
                        </a>
                    </div>
                    <div class="col-sm-3">
                        {{ Form::open(['route' => ['trade.delete', $trade->uuid], 'method' => 'DELETE']) }}
                            <button class="btn btn-danger btn-block btn-sm" type="submit">
                                <i class="fas fa-trash-alt"></i> Delete Trade Listing
                            </button>
                        {{ Form::close() }}
                    </div>
                    @if($trade->isExpired)
                        <div class="col-sm-3">
                            {{ Form::open(['route' => ['trade.renew', $trade->uuid], 'method' => 'PUT']) }}
                            <button type="submit" class="btn btn-success btn-block btn-sm">
                                <i class="fas fa-arrow-up"></i> Renew Listing
                            </button>
                            {{ Form::close() }}
                        </div>
                    @endif
                </div>
                <hr>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-sm-5">
            @include('trade.partials.viewSoldItemSummary', ['trade' => $trade])
        </div>
        <div class="col-sm-5">
            @include('trade.partials.viewPaymentItemSummary', ['trade' => $trade])
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <h4>Seller Information</h4>
            <hr>
        </div>
        <div class="col-sm-4">
            @include('user.partials.userInfoCard', ['user' => $trade->user])
        </div>
        <div class="col-sm-8">
            @include('user.partials.userTrades', ['user' => $trade->user])
        </div>
    </div>

@endsection
