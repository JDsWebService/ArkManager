@extends('layouts.appBlank')

@section('title', "Documentation In " . $category . " Category")

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <ul class="list-group list-group-flush">
                @foreach($docs as $doc)
                    <li class="list-group-item bg-transparent border-0">
                        <a href="{{ route('documentation.view.single', [$doc->category, $doc->slug]) }}" class="text-decoration-none" style="font-size: 12pt;">
                            <i class="fas fa-file-alt mr-3"></i> {{ $doc->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ $docs->links('pagination.app') }}
        </div>
    </div>

@endsection
