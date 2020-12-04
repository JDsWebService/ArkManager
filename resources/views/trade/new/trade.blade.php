@extends('layouts.user')

@section('title', 'New Trade')

@section('content')

    {{ Form::open(['route' => 'trade.new.config.items', 'method' => 'GET']) }}
        <div class="row justify-content-center text-center">
            <div class="col-sm-6">
                <h4>What are you selling?</h4>
                <hr>
                <!-- Item -->
                <select name="sold_item" class="form-control">
                    @foreach($items as $key => $value)
                        @if(request()->input('sold_item') == $key)
                            <option value="{{ $key }}" selected>{{ $value }}</option>
                        @else
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6">
                <h4>What do you want as payment?</h4>
                <hr>
                <!-- Item -->
                <select name="payment_item" class="form-control">
                    @foreach($items as $key => $value)
                        @if(request()->input('sold_item') == $key)
                            <option value="{{ $key }}" selected>{{ $value }}</option>
                        @else
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-sm-6">
                <button class="btn btn-block btn-primary" type="submit">
                    Go To Next Step <i class="fas fa-step-forward"></i>
                </button>
            </div>
        </div>
    {{ Form::close() }}

@endsection
