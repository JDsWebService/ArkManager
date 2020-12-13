@extends('layouts.appBlank')

@section('title', $doc->title)

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <p>
                <span class="text-muted">Last Updated: </span> {{ \Carbon\Carbon::parse($doc->updated_at)->diffForHumans() }}
                <br>
                <span class="text-muted">Written By: </span> {{ $doc->user->username }}
                <br>
                <span class="text-muted">Category: </span> {{ $doc->category }}
            </p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-10">
            {!! $doc->body !!}
        </div>
    </div>

@endsection
