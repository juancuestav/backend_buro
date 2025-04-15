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
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <script>
        @auth
        window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
        @else
            window.Permissions = [];
        @endauth
    </script>
</head>

<body>
    @inertia

    {{-- Tabulator table: pdf --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>

    {{-- Tabulator table: excel --}}
    <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

    {{-- <script src="/js/html2pdf.bundle.min.js"></script> --}}

    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
