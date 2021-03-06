<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js',true) }}" defer></script>
    <script src="https://kit.fontawesome.com/85786d5dac.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css',true) }}" rel="stylesheet">
    <link href="{{ asset('css/samazon.css',true)}}" rel="stylesheet">
</head>
<body>
<div id="app">
    @component('components.header')
    @endcomponent

    <main class="py-4 mb-5">
        @yield('content')
    </main>

    @component('components.footer')
    @endcomponent
</div>
</body>
</html>
