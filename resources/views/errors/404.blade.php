@extends('layouts/layout')
<style>
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        color: #B0BEC5;
        display: table;
        font-weight: 100;
        font-family: 'Lato';
    }

    .container {
        text-align: center;
        display: block;
        vertical-align: middle;
    }

    .content {
        text-align: center;
        display: inline-block;
    }

    .title {
        font-size: 72px;
        margin-bottom: 40px;
    }
</style>
@section('content')
<div class="container">
    <div class="content">
        <div class="title">404</div>
        <div class="title">Page Not Found</div>
    </div>
</div>
@endsection