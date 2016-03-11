@extends('layouts.layout')
@section('title', 'Second task')

@section('content')

    <div class="container" role="main">
        <code>&lt;?php</code>
        <br><br>
        <code><var>$array</var> = range(0, 10);</code>
        <br>
        <code>shuffle(<var>$array</var>);</code>
        <br><br>
        <code>?&gt;</code>

        <h4><code>result:</code></h4>
        {{ dump($array) }}

        <div class="form-group">
            <a href="{{ url('second') }}" class="btn btn-info">refresh</a>
        </div>
    </div>
@endsection