@extends('layouts.admin')

@section('title', 'Documentation Index')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table table-sm table-borderless table-hover text-center">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Liked</th>
                    <th scope="col">Disliked</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($docs as $document)
                        <tr>
                            <td>{{ $document->title }}</td>
                            <td>{{ $document->category }}</td>
                            <td>{{ $document->liked }}</td>
                            <td>{{ $document->disliked }}</td>
                            <td>
                                {{ Form::open(['route' => ['admin.documentation.delete', $document->slug], 'method' => 'DELETE']) }}
                                <a href="{{ route('admin.documentation.edit', $document->slug) }}" class="btn btn-primary">
                                    Edit
                                </a>
                                <button class="btn btn-danger" type="submit">
                                    Delete
                                </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-12">
            {{ $docs->links() }}
        </div>
    </div>

@endsection
