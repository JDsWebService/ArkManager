@extends('layouts.admin')

@section('title', 'Force Login')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-6">
            {{ Form::open(['route' => 'admin.force.login', 'method' => 'POST']) }}

            <label for="email">eMail Address</label>
            <input class="form-control" type="text" name="email" placeholder="text@example.com" />

            <button class="btn btn-primary btn-block mt-3" type="submit">
                Force Login As This User
            </button>

            {{ Form::close() }}
        </div>
    </div>

@endsection
