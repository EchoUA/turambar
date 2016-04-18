@extends('layouts.layout')
@section('title', 'Test index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if($baskets->count())
                    <h2>Available baskets with content</h2>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Capacity</th>
                            <th>Contents</th>
                        </tr>
                        </thead>
                        @foreach($baskets as $basket)
                            <tr>
                                <td>{{ $basket->id }}</td>
                                <td>{{ $basket->name }}</td>
                                <td>{{ $basket->capacity }}</td>
                                <td>
                                    <ul class="list-unstyled">
                                        @unless($basket->items->isEmpty())
                                            @foreach($basket->items as $item)
                                                <li>{{ $item->type . ' - ' . $item->weight . 'kg'}}</li>
                                            @endforeach
                                        @endunless
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif

                <h2>Baskets</h2>
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
                            <td>Get Baskets list</td>
                            <td><input type="text" value="{{ url('api', ['v1', 'baskets']) }}" class="form-control" readonly></td>
                            <td><code>GET</code></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Create new basket</td>
                            <td><input type="text" value="{{ url('api', ['v1', 'baskets']) }}" class="form-control" readonly></td>
                            <td><code>POST</code></td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>key - <code>name</code></li>
                                    <li>key - <code><em>(int)</em> capacity</code></li>
                                </ul>
                            </td>
                        </tr>

                        <tr>
                            <td>Get specific basket</td>
                            <td><input type="text" value="{{ urldecode(url('api', ['v1', 'baskets', '{id}'])) }}" class="form-control" readonly></td>
                            <td><code>GET</code></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Edit specific basket</td>
                            <td><input type="text" value="{{ urldecode(url('api', ['v1', 'baskets', '{id}'])) }}" class="form-control" readonly></td>
                            <td><code>PUT</code></td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>key - <code><em>(string)</em> name</code></li>
                                    <li>key - <code><em>(int)</em> capacity</code></li>
                                </ul>
                            </td>
                        </tr>

                        <tr>
                            <td>Delete specific basket</td>
                            <td><input type="text" value="{{ urldecode(url('api', ['v1', 'baskets', '{id}'])) }}" class="form-control" readonly></td>
                            <td><code>DELETE</code></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Get items from specific basket</td>
                            <td><input type="text" value="{{ urldecode(url('api', ['v1', 'baskets', '{id}', 'items'])) }}" class="form-control" readonly></td>
                            <td><code>GET</code></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Add items to specific basket</td>
                            <td><input type="text" value="{{ urldecode(url('api', ['v1', 'baskets', '{id}', 'items'])) }}" class="form-control" readonly></td>
                            <td><code>POST</code></td>
                            <td>
                                <ul class="list-unstyled">
                                    <li>key - <code>(array) items[*]</code></li>
                                    <li> value - <code><em>(int)</em> item ID</code></li>
                                </ul>
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-md-4">
                <h2>TRY</h2>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ url('/') }}" method="post">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <div class="btn-toolba">
                                    <div class="btn-group">
                                        <input type="text" class="form-control" placeholder="URL" name="url">
                                    </div>
                                    <div class="btn-group">
                                        <select class="form-control" name="method" id="" title="Choose method">
                                            <option value="GET">GET</option>
                                            <option value="POST">POST</option>
                                            <option value="PUT">PUT</option>
                                            <option value="DELETE">DELETE</option>
                                        </select>
                                    </div>
                                    <div class="btn-group">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </div>
                            <div class="additional_fields">

                            </div>
                        </form>
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