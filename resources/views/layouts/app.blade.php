<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/static/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('/static/js/app.js') }}" defer></script>
    <title>Meetup app</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
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
