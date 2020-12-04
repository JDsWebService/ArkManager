@extends('layouts.user')

@section('title', 'Confirm Trade Values')

@section('content')

    {{ Form::open(['route' => 'trade.new.store', 'method' => 'POST']) }}
    @include('trade.partials.summaryHiddenFields', ['request' => $request])

    <div class="row justify-content-center text-center">
        <div class="col-sm-12">
            <p class="lead">Does the information look accurate to you? If so, please click on the <span class="text-success">Confirm Trade</span> button below.</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-5">
            @include('trade.partials.soldItemSummary', ['item' => $soldItem, 'request' => $request])
        </div>
        <div class="col-sm-5">
            @include('trade.partials.paymentItemSummary', ['item' => $paymentItem, 'request' => $request])
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-sm-8">
            <h4>Trade Settings</h4>
            <hr>
            <div class="form-group row mb-4">
                <label class="col-sm-6 col-form-label">Is bartering allowed?</label>
                <div class="col-sm-6 text-center">
                    <label class="switch s-icons s-outline s-outline-primary mr-2">
                        <input type="hidden" name="bartering_allowed" value="0">
                        <input type="checkbox" name="bartering_allowed" value="1">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-sm-6 col-form-label">Trade Duration</label>
                <div class="col-sm-6">
                    <input type="text" value="8 hours" class="form-control" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-4">
            <a href="{{ route('user.dashboard') }}" class="btn btn-block btn-danger">
                <i class="far fa-window-close"></i> Cancel Trade
            </a>
        </div>
        <div class="col-sm-4">
            <button class="btn btn-primary btn-block" type="submit">
                <i class="fas fa-check"></i> Confirm Trade
            </button>
        </div>
    </div>

    {{ Form::close() }}

@endsection
