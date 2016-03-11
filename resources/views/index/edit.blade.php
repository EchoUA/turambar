@extends('layouts.layout')

@section('title', 'Edit movie')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include('errors.list')

                <h1 class="text-center">Add a new article</h1>

                <form action="{{ action('IndexController@update', $movies->id) }}" method="POST" class="form-horizontal">
                    {{ method_field('PUT') }}
                    @include('index.form')
                </form>
            </div>
        </div>
    </div>
@endsection