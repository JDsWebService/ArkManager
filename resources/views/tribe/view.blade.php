@extends('layouts.user')

@section('title', 'Viewing ' . $tribe->name . ' Tribe')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-4">
            @include('tribe.partials.tribeCard', ['tribe' => $tribe])
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Tribe Description</h4>
                    <hr>
                    {!! $tribe->description !!}
                </div>
            </div>
            <div class="row mt-3">
                <h4>Tribe Members</h4>
                <hr>
                <table class="table table-sm table-borderless table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Active Trades</th>
                        <th scope="col">Dinos Being Tracked</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tribe->users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->trades->count() }}</td>
                                <td>{{ $user->dinos->count() }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-small">View Profile</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
