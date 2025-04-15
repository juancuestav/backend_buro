<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        .container {
            padding: 20px 40px;
        }

        .mb-4 {
            margin-bottom: 32px;
        }

        table,
        td,
        th {
            border: 1px solid #eee;
            padding: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            border-bottom: 2px solid #000;
            background-color: #ddd;
        }

        .text-center {
            text-align: center;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .me-2 {
            padding-right: 8px;
        }

        /* Cabeceras */
        .cabecera-pedido {
            display: inline-block;
            width: 100%;
            height: 120px;
        }

        .cabecera-pedido .logo {
            height: 60px;
            padding: 48px 0 0 0;
            float: left;
        }

        .cabecera-pedido .empresa {
            text-align: center;
        }

        .cabecera-pedido .empresa span {
            display: block;
            margin-bottom: 8px;
        }

        .nombre-empresa {
            color: #001f3f;
            font-weight: bold;
            font-size: 1.6em;
            margin-top: 14px;
            display: block;
        }

        .informacion {
            overflow: auto;
            height: 120px;
        }

        .informacion .pedido {
            float: left;
        }

        .informacion .pedido span {
            display: block;
            margin-bottom: 8px;
        }

        .informacion .cliente {
            float: right;
            text-align: right;
        }

        .informacion .cliente span {
            display: block;
            margin-bottom: 8px;
        }
    </style>
</head>

<body class="text-color">
    <div class="container">
        <div class="cabecera-pedido mb-4">
            <img src="{{ asset('img/logo.webp') }}" alt="" class="logo">
            <div class="empresa">
                <span class="nombre-empresa">Buró de crédito Ecuador</span>
                <span><b>Correo:</b> atencionclientes@burodecredito.ec</span>
            </div>
        </div>

        <div class="informacion">
            <div class="pedido">
                <span><b>Pedido No.</b> {{ $pedido->numero_orden }}</span>
                <span><b>Fecha de emisión:</b> {{ $pedido->fecha_emision }}</span>
                <span><b>Método de pago:</b> {{ $pedido->metodo_pago }}</span>
            </div>

            <div class="cliente">
                <span><b>Cliente:</b> {{ $pedido->marketings->nombre . ' ' . $pedido->marketings->apellidos }}</span>
                <span><b>Identificación:</b> {{ $pedido->marketings->identificacion }}</span>
                <span><b>Celular:</b> {{ $pedido->marketings->celular }}</span>
            </div>
        </div>

        <h4 class="text-center">COMPROBANTE DE CONSUMIDOR FINAL</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-start">Descripción</th>
                    <th class="text-end">Precio unitario</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedido->lineas_pedido as $linea_pedido)
                    <tr>
                        <td>{{ $linea_pedido->servicios->nombre }}</td>
                        <td class="text-end">
                            {{ '$ ' . priceFormat($linea_pedido->servicios->precio_unitario + $linea_pedido->servicios->iva) }}
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
    </div>
</body>

</html>
