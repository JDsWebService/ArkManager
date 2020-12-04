@extends('layouts.user')

@section('title', 'Your Trade Hub Dashboard')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            @include('trade.partials.userActiveTrades', ['trades' => $activeTrades])
        </div>
        <div class="col-sm-12">
            @include('trade.partials.userArchivedTrades', ['trades' => $archivedTrades])
        </div>
    </div>

@endsection
