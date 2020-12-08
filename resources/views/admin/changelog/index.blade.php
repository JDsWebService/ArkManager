@extends('layouts.admin')

@section('title', 'Viewing Changelog Entries');

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table table-sm table-hover table-borderless text-center">
                <thead>
                    <tr>
                        <th scope="col">Version</th>
                        <th scope="col">Change Type</th>
                        <th scope="col">Version Type</th>
                        <th scope="col">Category</th>
                        <th scope="col">Prerelease Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->full_version_string }}</td>
                            <td>{{ $log->change_type }}</td>
                            <td>{{ $log->version_type }}</td>
                            <td>{{ $log->category }}</td>
                            <td>
                                @if($log->prerelease)
                                    <span class="text-success">True</span>
                                @else
                                    <span class="text-danger">False</span>
                                @endif
                            </td>
                            <td>
                                {{ Form::open(['route' => ['admin.changelog.delete', $log->id], 'method' => 'DELETE']) }}
                                <a href="{{ route('admin.changelog.edit', $log->id) }}" class="btn btn-sm btn-info">
                                    <i class="far fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $logs->links() }}
        </div>
    </div>

@endsection
