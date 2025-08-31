@extends('layouts.app')

@section('content')
    <div class="imagen-con-texto">
        <h2><b>Potencia y focaliza mejor las estrategias de tu negocio con nuestras soluciones empresariales </b> que
            combinan datos, análisis y tecnología.</h2>
    </div>

    <div class="container pt-4" style="margin-bottom: calc(100vh - 550px)">

        <h2 class="text-center">¡Tenemos la solución que tu <b>Empresa o Negocio</b> necesita!</h2>

        {{-- Reportes --}}
        @if (count($solucionesEmpresas) > 0)
            <div id="reportes" class="row row-cols-md-4 row-cols-1 pt-4 mb-4">
                @foreach ($solucionesEmpresas as $plan)
                    <div class="col mb-2">
                        <div class="card rounded-card h-100 gradiente-azul-morado text-white">
                            {{-- Imagen --}}
                            <div class="card-body h-100">
                                @if ($plan->images?->url)
                                    <div class="text-center">
                                        <img width="100px" class="mb-4" src="{{ $plan->images?->url }}" alt="">
                                    </div>
                                @endif

                                {{-- Contenido --}}
                                <div class="w-100">
                                    <h4 class="fw-bold text-center mb-4">{{ $plan->nombre }}</h4>
                                    <div class="mb-4 text-black bg-desenfoque rounded-card p-2">{!! $plan->descripcion !!}
                                    </div>

                                    <div class="fs-4 text-center fw-bold">
                                        {{ '$' . priceFormat($plan->precio_unitario + $plan->iva) }}</div>

                                    @if ($plan->gravable)
                                        <div class="text-center">IVA incluido</div>
                                    @else
                                        <small class="text-center d-block">Precio final (No incluye IVA)</small>
                                    @endif

                                    <div class="text-center text-md-start my-3">
                                        {{-- <a href="{{ $plan->url_destino }}" target="_blank"
                                            class="btn btn-primary fw-bold w-100">Obtener ahora
                                        </a> --}}
                                        <a href="{{ route('public.servicios.show', $plan) }}"
                                            class="btn btn-primary fw-bold px-3 rounded-pill my-3 w-100">Adquirir servicio
                                            <i class="bi-chevron-right"></i></a>
                                    </div>
                                    <div class="text-center">
                                        <i class="bi-bookmark-check-fill me-2 text-success"></i>TU COMPRA ES SEGURA </br>
                                        <small>*Buró de crédito muestra información preliminar.</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            {{--  @else
            <p class="ps-3 pt-3 text-white">Aún no se han agregado planes!</p> --}}
        @endif
    </div>
@endsection

@section('css')
    <style>
        .imagen-con-texto {
            position: relative;
            width: 100%;
            height: 300px;
            background-image: url('/img/soluciones_empresas2.webp');
            /* Puedes reemplazar esta URL */
            background-size: cover;
            background-position: bottom;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .imagen-con-texto h2 {
            background: rgba(0, 0, 0, 0.5);
            /* fondo semitransparente */
            padding: 10px 20px;
            border-radius: 8px;
            max-width: 60%;
            font-size: 1.2rem;
        }
    </style>
@endsection
