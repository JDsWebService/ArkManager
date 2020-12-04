@extends('layouts.user')

@section('title', 'Viewing Trade For ' . $trade->soldItem->name)

@section('content')

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
