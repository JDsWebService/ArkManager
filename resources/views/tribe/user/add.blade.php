@extends('layouts.user')

@section('title', 'Add User To ' . $tribe->name . ' Tribe')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-6">
            {{ Form::open(['route' => ['tribe.management.user.sendEmail', $tribe->uuid], 'method' => 'POST']) }}

                <label for="receiving_user">Enter Tribemate's Discord Username or eMail Address</label>
                <input type="text" name="receiving_user" class="form-control" placeholder="Username#1234 OR email@example.com">

                <button class="btn btn-success btn-block mt-3" type="submit">
                    Add User To Tribe
                </button>
            {{ Form::close() }}
        </div>
    </div>

@endsection
