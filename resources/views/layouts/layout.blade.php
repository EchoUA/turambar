<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
<div class="wrapper" style="margin-top: 80px;">
    @include('layouts.navbar')
    @yield('profile.navbar')

    @yield('content')
</div>

<script src="/js/jquery-2.1.1.js"></script>
<script src="/js/custome.js"></script>
</body>
</html>
