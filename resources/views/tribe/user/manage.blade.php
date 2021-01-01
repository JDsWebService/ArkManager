@extends('layouts.user')

@section('title', 'Manage Tribemates')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-sm table-borderless table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Active Trades</th>
                        <th scope="col">Dinos Tracked</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tribe->users as $user)
                        <tr>
                            <td>{{ $user->fullusername }}</td>
                            <td>{{ $user->trades->count() }}</td>
                            <td>{{ $user->dinos->count() }}</td>
                            <td>
                                {{ Form::open(['route' => ['tribe.management.user.remove', $user->id], 'method' => 'DELETE']) }}
                                    <button type="submit" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i> Remove
                                    </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
