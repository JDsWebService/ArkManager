@extends('layouts.admin')

@section('title', 'Add New Changelog Entry')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-8">
            {{ Form::open(['route' => 'admin.changelog.store', 'method' => 'POST']) }}

            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <label for="type">Version Type</label>
                    {{ Form::select('version_type', ['major' => 'Major', 'minor' => 'Minor', 'patch' => 'Patch'], null, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    <label for="type">Change Type</label>
                    {{ Form::select('change_type', ['add' => 'Add', 'change' => 'Change', 'fix' => 'Fix'], null, ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    <label for="category">Category</label>
                    {{ Form::select('category', $categories, null, ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <label for="description" class="mt-3">Change Description</label>
                    {{ Form::text('description', null, ['class' => 'form-control']) }}

                    <div class="row form-group mt-3">
                        <label for="prerelease" class="col-sm-10 col-form-label">Is this change during prerelease?</label>
                        <div class="col-sm-2">
                            <label class="switch s-icons s-outline s-outline-primary mr-2">
                                <input type="hidden" name="prerelease" value="0">
                                <input type="checkbox" name="prerelease" value="1">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-block btn-primary mt-3" type="submit">
                Add To Changelog
            </button>
            {{ Form::close() }}
        </div>
    </div>

@endsection
