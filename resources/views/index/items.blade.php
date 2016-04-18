@extends('layouts.layout')
@section('title', 'Test index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Available items</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Weight</th>
                    </tr>
                    </thead>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->weight }}</td>
                        </tr>
                    @endforeach
                </table>

                <h2>Items</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Method</th>
                        <th>Required params</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Get items list</td>
                        <td><input type="text" class="form-control" value="{{ url('api', ['v1', 'items']) }}" readonly></td>
                        <td><code>GET</code></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Get specific item</td>
                        <td><input type="text" class="form-control" value="{{ urldecode(url('api', ['v1', 'items', '{id}'])) }}" readonly></td>
                        <td><code>GET</code></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h2>TRY</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form action="{{ url('items') }}" method="post">
                                {{ csrf_field() }}
                                <div class="btn-toolba">
                                    <div class="btn-group">
                                        <input type="text" class="form-control" placeholder="URL" name="url">
                                    </div>
                                    <div class="btn-group">
                                        <select class="form-control" name="method" id="" title="Choose method">
                                            <option value="GET">GET</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @unless(is_null($response))
                            {{ dump($response->json()) }}
                            {!! '<pre>' . json_encode($response->json(), JSON_PRETTY_PRINT) . '</pre>' !!}
                        @endunless
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop