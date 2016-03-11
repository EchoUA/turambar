@extends('layouts.layout')

@section('title', 'Add a new movie')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include('errors.list')

                <h1 class="text-center">Add a new article</h1>

                <form action="{{ url('movie') }}" method="post" class="form-horizontal">
                    @include('index.form')
                </form>
            </div>
        </div>
    </div>
@endsection