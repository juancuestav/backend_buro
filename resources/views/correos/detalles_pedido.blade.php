<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('img/logo.webp') }}">
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
    <div class="card shadow">
        <img height="80" src="{{ asset('img/logo.webp') }}" alt="logo de buro app" class="logo">

        <div class="mb-4">
            <p>Hola, <strong>{{ Auth::user()->getFullname() }}</strong>.</p>
            <p>Te informamos que hemos recibido tu pedido!</p>

            <p class="mb-4">Nos alegra que hayas adquirido nuestros servicios. En un momento nos pondremos en
                contacto contigo.
            </p>
            <p>Estado del pedido: <b>{{ $pedido->estado_pago }}</b></p>
            <p class="mb-4">Método de pago: <b>{{ $pedido->metodo_pago }}</b></p>
        </div>

        <h4 class="text-center">DETALLES DE SU PEDIDO</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Descripción</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedido->lineas_pedido as $linea_pedido)
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset($linea_pedido->servicios->images?->url . '') }}" alt=""
                                width="100">
                        </td>
                        <td class="">
                            {{ $linea_pedido->servicios->nombre }}
                        </td>
                        <td class="text-end">{{ '$ ' . priceFormat($linea_pedido->precio) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-end me-2"><b>Subtotal:<b></td>
                    <td class="text-end">{{ '$ ' . priceFormat($pedido->subtotal) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-end me-2"><b>IVA (incluido):<b></td>
                    <td class="text-end">{{ '$ ' . priceFormat($pedido->iva) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-end me-2"><b>Total del pedido:<b></td>
                    <td class="text-end">{{ '$ ' . priceFormat($pedido->total) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="space"></div>
        @if ($pedido->metodo_pago == \App\Models\Pedido::DEPOSITO)
            <p>Cuenta: <b>{{ $configuracion_general['numero_cuenta'] }}</b></p>
            <p>Entidad financiera: <b>{{ $configuracion_general['entidad_financiera'] }}</b></p>
            <p>Propietario de la cuenta: <b>{{ $configuracion_general['propietario_cuenta'] }}</b></p>
            <p>Identificación del propietario de la cuenta:
                <b>{{ $configuracion_general['identificacion_propietario_cuenta'] }}</b>
            </p>
            <small>Por favor, realice la transferencia o depósito y luego póngase en contacto con nosotros mediante
                el/los número(s) {{ $configuracion_general['numero_contacto'] }}</small>
        @endif
        <p class="text-end mb-4">Gracias por preferirnos!</p>

        <div class="text-center mb-5">
            @if ($pedido->metodo_pago == \App\Models\Pedido::TARJETA)
                <a href="{{ url($configuracion_general['url_pago_tarjeta']) }}" class="btn btn-success mb-1"
                    target="_blank" style="color: #fff">Realizar pago</a>
            @endif
            <a href="{{ url('') }}" class="btn btn-primary mb-1" style="color: #fff">Visitar burodecredito.ec</a>
            <a href="{{ url('admin/mis-pedidos/page') }}" class="btn btn-primary" style="color: #fff">Consultar mis
                pedidos</a>
        </div>
        <small class="d-block py-5 text-secondary">@ Copyright 2025 {{ $configuracion_general['nombre_empresa'] }} </small>

    </div>
</body>

</html>
