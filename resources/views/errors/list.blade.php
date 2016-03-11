@if($errors->any())
    <div class="alert alert-danger">
    <ul>
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif