@extends('layouts.user')

@section('title', 'Your Tracked Dinos')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table-hover table-borderless table-sm w-100 text-center">
                <thead>
                    <tr>
                        <th scope="col" style="width: 36px;"></th>
                        <th scope="col">Dino Breed</th>
                        <th scope="col">Base Level</th>
                        <th scope="col">Highest Mutated Level</th>
                        <th scope="col">Mutation Type</th>
                        <th scope="col">Base Mutation Value</th>
                        <th scope="col">Highest Mutation Value</th>
                        <th scope="col">Current Mutation Count</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($baseDinos as $dino)
                        <tr>
                            <td>
                                <img src="{{ asset("{$dino->metaInfo->image_public_path}") }}" alt="{{ $dino->metaInfo->name }} Icon" class="dino-index-image">
                            </td>
                            <td><span class="text-info">{{ $dino->metaInfo->name }}</span></td>
                            <td>{{ $dino->level }}</td>
                            <td><span class="text-success">{{ $dino->newestDinoLevel }}</span></td>
                            <td><span class="text-warning">{{ $dino->mutation_type }}</span></td>
                            <td>
                                {{ $dino->baseDinoStatValue }}
                            </td>
                            <td>
                                <span class="text-success">{{ $dino->newestDinoStatValue }}</span>
                            </td>
                            <td>{{ $dino->lineMutationCount }}</td>
                            <td>
                                <a href="{{ route('dino.show.line', $dino->uuid) }}" class="btn btn-sm btn-primary">View Line</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $baseDinos->links() }}
        </div>
    </div>

@endsection
