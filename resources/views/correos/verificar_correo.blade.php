<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        body {
            background: #f2f2f2;
            height: 100vh;
        }

        .card {
            border-radius: 8px;
            background-color: #fff;
            margin: 20px;
            padding: 20px 20px;
        }

        .text-center {
            text-align: center;
        }

        .mb-1 {
            margin-bottom: 6px;
        }

        .mb-4 {
            margin-bottom: 32px;
        }

        .mb-5 {
            margin-bottom: 40px;
        }

        .background {
            background-color: #f8f8f8;
        }

        .d-block {
            display: block;
        }

        table,
        td,
        th {
            border: 1px solid rgba(0, 0, 0, .2);
            padding: 4px 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            border-bottom: 2px solid #000;
            background-color: #7aa815;
            color: #fff;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: end;
        }

        .me-2 {
            padding-right: 8px;
        }

        .space {
            padding: 10px 0;
        }

        .btn {
            padding: 12px 16px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-success {
            background-color: #7aa815;
        }

        .btn-primary {
            background-color: #1a1e21;
        }

        .logo {
            padding: 10px;
            float: right;
        }

        .shadow {
            box-shadow: rgba(44, 54, 92, 0.2) 0px 5px 15px;
        }

        @media (max-width: 576px) {
            .btn {
                display: block;
            }

            .logo {
                display: block;
                float: none;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <img height="80" src="{{ asset('img/logo.webp') }}" alt="logo de buro app" class="logo">

    <div class="mb-4">
        {{-- <p>Hola, <strong>{{ Auth::user()->getFullname() }}</strong>.</p> --}}
        <p>Felicidades, has creado tu cuenta con éxito!</p>

        <p class="mb-4">Tu código de seguridad es: {{ $codigo }}
        </p>
    </div>
</body>

</html>
