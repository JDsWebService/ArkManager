@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <h3>Welcome Back {{ $user->username }}</h3>
            <hr>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias autem commodi dignissimos dolores explicabo id illum inventore ipsa libero minus nobis nulla numquam praesentium quo reprehenderit tempore voluptas, voluptate!
            </p>
        </div>
    </div>

@endsection
