@extends('layouts.app')

@section('title', 'Most Recent Changes')

@section('content')

    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-sm-8">
                <h1>Most Recent Changes</h1>
                <hr>
                <p class="lead">These are the most recent changes for <strong class="text-info">Version {{ $latestVersion->major_version }}</strong>. The following include Add's, Change's, and Patches.</p>
                <h2>Adds</h2>
                <ul>
                    @if($latestVersion->adds->count() == 0)
                        <span class="text-info">No additions were made yet in Version {{ $latestVersion->major_version }}.</span>
                    @else
                        @foreach($latestVersion->adds as $version)
                            <li>
                                {{ $version->full_version_string }} ({{ $version->category }}) - {{ $version->description }}
                            </li>
                        @endforeach
                    @endif
                </ul>
                <h2>Changes</h2>
                <ul>
                    @if($latestVersion->changes->count() == 0)
                        <span class="text-info">No changes were made yet in Version {{ $latestVersion->major_version }}.</span>
                    @else
                        @foreach($latestVersion->changes as $version)
                            <li>
                                {{ $version->full_version_string }} ({{ $version->category }}) - {{ $version->description }}
                            </li>
                        @endforeach
                    @endif
                </ul>
                <h2>Fixes / Patches</h2>
                <ul>
                    @if($latestVersion->fixes->count() == 0)
                        <span class="text-info">No fixes / patches were made yet in Version {{ $latestVersion->major_version }}.</span>
                    @else
                        @foreach($latestVersion->fixes as $version)
                            <li>
                                {{ $version->full_version_string }} ({{ $version->category }}) - {{ $version->description }}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-sm-4">
                <h1>Other Versions</h1>
                <hr>
                <ul class="list-group list-group-flush">
                    @foreach($versionNumbers as $number)
                        <li class="list-group-item bg-transparent">
                            <a href="{{ route('changelog.view', $number) }}">Version {{ $number }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
