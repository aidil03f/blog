<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'laravel_pos'}}</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
</head>
<body>
    @include('layouts.navigation')
   <div class="py-4">
       @include('alert')
       @yield('content')
   </div>
   <script src="http://code.jquery.com/jquery-3.5.1.min.js"
           integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
           crossorigin="anonymous"></script>
   <script src="/js/bootstrap.js"></script>
</body>
</html>