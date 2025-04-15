<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo.webp') }}">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body>
    <main>
        @yield('content')
    </main>

    {{-- <script src="{{ mix('js/full-app.js') }}" defer></script> --}}
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    {{-- Google Adsense --}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6980207264038332"
        crossorigin="anonymous"></script>

    @yield('js')
</body>

</html>
