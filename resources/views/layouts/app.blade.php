<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/static/css/app.css') }}">
    <title>Meetup app</title>
</head>
<body class="flex bg-gray-100 flex-col min-h-screen">
    @include('partials.navbar')
    <div class="flex-grow">
        @yield('content')
    </div>
    @include('partials.footer')
    <script src="{{ asset('/static/js/navbar.js') }}"></script>
    <script src="{{ asset('/static/js/userMenu.js') }}"></script>
    <script src="{{ asset('/static/js/meetupImage.js') }}"></script>
</body>
</html>
