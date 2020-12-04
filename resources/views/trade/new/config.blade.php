@extends('layouts.user')

@section('title', 'Configure Trade Options')

@section('content')

    {{ Form::open(['route' => 'trade.new.summary', 'method' => 'POST']) }}

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <p>On this page you will configure the selling item values and the payment item values for your new trade. <span class="text-danger">All fields are required.</span></p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <img src="{{ $soldItem->image_public_path }}" style="width:120px; height 120px;" alt="{{ $soldItem->name }} Icon">
                </div>
                <div class="col-sm-8">
                    <h4>Item Being Sold</h4>
                    <p>This information is for the item (<span class="text-success">{{ $soldItem->name }}</span>) that you're <span class="text-success">selling</span>.
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <img src="{{ $paymentItem->image_public_path }}" style="width:120px; height 120px;" alt="{{ $paymentItem->name }} Icon">
                </div>
                <div class="col-sm-8">
                    <h4>Buying {{ $paymentItem->name }}</h4>
                    <p>This information is for the item (<span class="text-success">{{ $paymentItem->name }}</span>) that you're <span class="text-success">buying</span>. All values for this item are relative.</p>
                    <p class="text-info small">Example: 100% Damage will show up on the trade hub as >= 100% Damage.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <!-- Begin Sell Item Config Div -->
        <div class="col-sm-6">
            @include('trade.partials.soldItemConfigFields', ['item' => $soldItem])
        </div>
        <!-- End Sell Item Config Div -->

        <!-- Begin Payment Item Config Div -->
        <div class="col-sm-6">
            @include('trade.partials.paymentItemConfigFields', ['item' => $paymentItem])
        </div>
        <!-- End Payment Item Config Div -->
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-sm-6">
            <button class="btn btn-block btn-primary">
                <i class="fas fa-list"></i> View Trade Summary
            </button>
        </div>
    </div>

    {{ Form::close() }}

@endsection
