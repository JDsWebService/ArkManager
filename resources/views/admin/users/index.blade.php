@extends('layouts.admin')

@section('title', "Users Index ({$totalUsers} Total)")

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table table-hover table-borderless table-sm text-center">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Username</th>
                        <th scope="col">eMail</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{{ \App\Handlers\UserHandler::getUserAvatar($user) }}" alt="{{ $user->fullusername }} Avatar" style="width:32px; height 32px;">
                            </td>
                            <td>{{ $user->fullusername }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->isOnline)
                                    <span class="text-success">ONLINE</span>
                                @else
                                    <span class="text-danger">OFFLINE</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('m-d-Y H:i:s') }}</td>
                            <td>
                                <a href="{{ route('admin.users.view', $user->id) }}" class="btn btn-primary btn-sm">
                                    <i class="far fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-8">
            {{ $users->links() }}
        </div>
    </div>

@endsection
