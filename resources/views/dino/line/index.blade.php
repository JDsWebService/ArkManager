@extends('layouts.user')

@section('title', \Auth::user()->tribe->name . " Breeding Lines")

@section('content')

    <table class="table table-hover table-sm text-center">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Dino Breed</th>
                <th scope="col">Mutation Type</th>
                <th scope="col">Mutation Count</th>
                <th scope="col">Last Updated</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($lines as $line)
                <tr>
                    <td style="width: 60px;">
                        <img src="{{ $line->dino->image_public_path }}" class="dino-index-image" alt="{{ $line->dino->name }}">
                    </td>
                    <td style="width: 20%;">{{ $line->dino->name }}</td>
                    <td>{{ $line->mutation_type }}</td>
                    <td>0</td>
                    <td>{{ \Carbon\Carbon::parse($line->updated_at)->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('dino.line.edit', $line->slug) }}" class="btn btn-secondary btn-sm">
                            <i class="far fa-edit"></i> Edit Base Stats
                        </a>
                        <!-- Delete Button Modal Trigger -->
                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#{{ $line->slug }}">
                            <i class="far fa-trash-alt"></i> Delete Line
                        </button>
                        {{ Form::open(['route' => ['dino.line.delete', $line->slug], 'method' => 'DELETE']) }}
                            @include('dino.line.partials.deleteLineModal', ['line' => $line])
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $lines->links() }}

@endsection
