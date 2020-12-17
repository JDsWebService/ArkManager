@extends('layouts.user')

@section('title', $dinoBreed . ' Colors')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12 text-justify">
            <p class="lead">
                The following page tells you what colors you currently have in the database for the dino breed listed above. If you have the color the value will say <span class="text-success">TRUE</span> and if you do not yet have the color the value will say <span class="text-danger">FALSE</span>.
            </p>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('color.upload') }}" class="btn btn-success btn-block">
                <i class="fas fa-upload"></i> Upload New Dino Color
            </a>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        @include('color.partials.colorTable', ['id' => 0, 'regionIds' => $regionZeroIds, 'colors' => $colors])
        @include('color.partials.colorTable', ['id' => 1, 'regionIds' => $regionOneIds, 'colors' => $colors])
        @include('color.partials.colorTable', ['id' => 2, 'regionIds' => $regionTwoIds, 'colors' => $colors])
        @include('color.partials.colorTable', ['id' => 3, 'regionIds' => $regionThreeIds, 'colors' => $colors])
        @include('color.partials.colorTable', ['id' => 4, 'regionIds' => $regionFourIds, 'colors' => $colors])
        @include('color.partials.colorTable', ['id' => 5, 'regionIds' => $regionFiveIds, 'colors' => $colors])
    </div>



@endsection
