@extends('layouts.layout')
@section('title', 'Test index')

@section('content')
    <div class="container" role="main">
        @if( ! $movies->isEmpty())
        <h2>Movies list</h2>

        <table class="table table-border table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>Name</th>
                <th>Year</th>
                <th>Is active </th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($movies as $movie)
                <tr>
                    <td><a href="{{ url('movie', $movie->id) }}">{{ $movie->name }}</a></td>
                    <td>{{ $movie->year }}</td>
                    <td>{{ $movie->isActive }}</td>
                    <td><a href="{{ url('movie', [$movie->id, 'edit']) }}">edit</a></td>
                    <td>
                        <form action="{{ action('IndexController@destroy', $movie->id) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{ method_field('DELETE') }}
                            <input type="submit" class="btn-link" value="delete">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <h3 class="text-center text-muted">List is empty</h3>
        @endif
    </div> <!-- /container -->
@endsection