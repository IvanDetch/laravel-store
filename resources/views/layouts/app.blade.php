<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <!-- Styles -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <!-- Custom styles -->
    <link rel="stylesheet" href="/public/styles/categories.css">
{{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
</head>
<body>
    <div id="app">
        @include('layouts.partials.navbar')
        <main class="py-1">
            @yield('content')
        </main>
        @include('layouts.partials.footer')
    </div>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <script type="text/javascript">
        new WOW().init();
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
