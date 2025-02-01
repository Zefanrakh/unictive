<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-link.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>

<body>
    <div class="app">
        @if (auth()->user())
            <x-header />
        @endif

        @if (session('message'))
            <x-message :type="session('message')['type']" :content="session('message')['content']" />
        @endif

        @yield('content')
    </div>

    <script src="{{ asset('js/message.js') }}"></script>
    <script src="{{ asset('js/hobbies.js') }}"></script>
</body>

</html>
