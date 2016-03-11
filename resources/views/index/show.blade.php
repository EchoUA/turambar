@extends('layouts.layout')
@section('title', $movies['name'])

@section('content')

    <div class="container" role="main">
        <table class="table table-bordered table-striped table-striped">
            <tbody>
            @foreach($movies as $key => $movie)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $movie }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection