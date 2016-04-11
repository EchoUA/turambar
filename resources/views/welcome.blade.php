<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <title>Test API</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
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
        </div>
        <div class="col-md-6">
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
                                    @if (\App\Item::whereIn('id', explode(',', $basket->contents))->get(['type', 'weight']))
                                        @foreach(\App\Item::whereIn('id', explode(',', $basket->contents))->get(['type', 'weight']) as $item)
                                            <li>{{ $item->type . ' - ' . $item->weight . 'kg'}}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>

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
            <td>{{ url('api', ['v1', 'items']) }}</td>
            <td><code>GET</code></td>
            <td></td>
        </tr>

        <tr>
            <td>Get specific item</td>
            <td>{{ url('api', ['v1', 'items', 'id']) }}</td>
            <td><code>GET</code></td>
            <td></td>
        </tr>
        </tbody>
    </table>

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
            <td>{{ url('api', ['v1', 'baskets']) }}</td>
            <td><code>GET</code></td>
            <td></td>
        </tr>

        <tr>
            <td>Create new basket</td>
            <td>{{ url('api', ['v1', 'baskets']) }}</td>
            <td><code>POST</code></td>
            <td>
                <ul>
                    <li><code>name</code></li>
                    <li><code><em>(int)</em> capacity</code></li>
                </ul>
        </tr>

        <tr>
            <td>Get specific basket</td>
            <td>{{ url('api', ['v1', 'baskets', 'id']) }}</td>
            <td><code>GET</code></td>
            <td></td>
        </tr>

        <tr>
            <td>Edit specific basket</td>
            <td>{{ url('api', ['v1', 'baskets', '*id']) }}</td>
            <td><code>POST (PUT/PATCH)</code></td>
            <td>
                <ul>
                    <li>key - <code>_method</code>, value - <code>PATCH</code> or <code>PUT</code></li>
                    <li><code><em>(string)</em> name</code></li>
                    <li><code><em>(int)</em> capacity</code></li>
                    <li><code><em>(array)</em> contents</code></li>
                </ul>
            </td>
        </tr>

        <tr>
            <td>Delete specific basket</td>
            <td>{{ url('api', ['v1', 'baskets', 'id']) }}</td>
            <td><code>DELETE</code></td>
            <td></td>
        </tr>

        <tr>
            <td>Add items to specific basket</td>
            <td>{{ url('api', ['v1', 'baskets', 'id', 'add']) }}</td>
            <td><code>POST</code></td>
            <td>
                <ul>
                    <li>key - <code>(array) items[*]</code>, value - <code><em>(int)</em> item ID</code></li>
                </ul>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
