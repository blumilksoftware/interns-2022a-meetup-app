<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/static/css/app.css') }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Meetup app</title>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="flex bg-gray-100 flex-col min-h-screen">
    @include('partials.navbar')
    <div class="flex-grow">
        @yield('content')
    </div>
    @include('partials.footer')
</body>
</html>
