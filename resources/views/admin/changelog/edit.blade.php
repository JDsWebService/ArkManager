@extends('layouts.admin')

@section('title', 'Edit Changelog Entry')

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-8">
            {{ Form::model($log, ['route' => ['admin.changelog.update', $log->id], 'method' => 'PUT']) }}

            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <label for="type">Version Type</label>
                    {{ Form::select('version_type', ['major' => 'Major', 'minor' => 'Minor', 'patch' => 'Patch'], $log->getRawOriginal('version_type'), ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    <label for="type">Change Type</label>
                    {{ Form::select('change_type', ['add' => 'Add', 'change' => 'Change', 'fix' => 'Fix'], $log->getRawOriginal('change_type'), ['class' => 'form-control']) }}
                </div>
                <div class="col-sm-4">
                    <label for="category">Category</label>
                    {{ Form::select('category', $categories, $log->getRawOriginal('category'), ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <label for="description" class="mt-3">Change Description</label>
                    {{ Form::text('description', $log->description, ['class' => 'form-control']) }}

                    <div class="row form-group mt-3">
                        <label for="prerelease" class="col-sm-10 col-form-label">Is this change during prerelease?</label>
                        <div class="col-sm-2">
                            <label class="switch s-icons s-outline s-outline-primary mr-2">
                                <input type="hidden" name="prerelease" value="0">
                                {{ Form::checkbox('prerelease', '1', $log->prerelease) }}
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-block btn-primary mt-3" type="submit">
                Save To Changelog
            </button>
            {{ Form::close() }}
        </div>
    </div>

@endsection
