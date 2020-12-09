@extends('layouts.admin')

@section('title', 'Edit Documentation - ' . $documentation->title)

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-12">
            {{ Form::model($documentation, ['route' => ['admin.documentation.update', $documentation->slug], 'method' => 'PUT']) }}

            <div class="row">
                <div class="col-sm-6">
                    <label for="title">Title</label>
                    {{ Form::text('title', $documentation->title, ['class' => 'form-control', 'placeholder' => 'Documentation Title']) }}
                </div>
                <div class="col-sm-6">
                    <label for="category">Category</label>
                    {{ Form::select('category', $categories, $documentation->getRawOriginal('category'), ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <x-tiny-m-c-e-editor margin="true" label="Documentation Content" placeholder="Write the next great documentation" id="body" model="{{ $documentation->body }}"/>
                </div>
            </div>

            <div class="row justify-content-center mt-3">
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-block" type="submit">
                        Save Documentation
                    </button>
                </div>
            </div>


            {{ Form::close() }}
        </div>
    </div>

@endsection
