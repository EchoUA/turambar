<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
<div class="wrapper">
    @include('layouts.navbar')
    @yield('profile.navbar')

    @yield('content')
</div>

</body>
</html>
