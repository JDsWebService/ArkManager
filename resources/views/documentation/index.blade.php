@extends('layouts.appBlank')

@section('title', 'Documentation')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-5">
            <h2>Newest Docs</h2>
            <div class="row">
                <div class="col-sm-12 p-3">
                    <ul class="list-group list-group-flush">
                        @foreach($newestDocs as $doc)
                            <li class="list-group-item bg-transparent">
                                <a href="{{ route('documentation.view.single', [$doc->category, $doc->slug]) }}" class="text-decoration-none" style="font-size: 12pt;">
                                    <i class="fas fa-file-alt mr-3"></i> {{ $doc->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="offset-1 col-sm-5">
            <h2>Most Popular Docs</h2>
            <div class="row">
                <div class="col-sm-12 p-3">
                    <ul class="list-group list-group-flush">
                        @foreach($popularDocs as $doc)
                            <li class="list-group-item bg-transparent">
                                <a href="{{ route('documentation.view.single', [$doc->category, $doc->slug]) }}" class="text-decoration-none" style="font-size: 12pt;">
                                    <i class="fas fa-file-alt mr-3"></i> {{ $doc->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <h2>All Categories</h2>
            <hr>
        </div>
        @foreach($docs as $category => $docs)
            @if($loop->odd)
                <div class="col-sm-5">
            @else
                <div class="offset-1 col-sm-5">
            @endif
                <h2>{{ $category }}</h2>
                <div class="row">
                    <div class="col-sm-12 p-3">
                        <ul class="list-group list-group-flush">
                            @foreach($docs as $doc)
                                <li class="list-group-item bg-transparent">
                                    <a href="{{ route('documentation.view.single', [$doc->category, $doc->slug]) }}" class="text-decoration-none" style="font-size: 12pt;">
                                        <i class="fas fa-file-alt mr-3"></i> {{ $doc->title }}
                                    </a>
                                </li>
                                @if($loop->iteration == 4)
                                    <li class="list-group-item bg-transparent">
                                        <a href="{{ route('documentation.view.category', $doc->category) }}" class="text-decoration-none" style="font-size: 12pt;">
                                            View All Docs In {{ $category }} Category
                                        </a>
                                    </li>
                                    @break
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
