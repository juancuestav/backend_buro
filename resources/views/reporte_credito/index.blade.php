@extends('layouts.app')

@section('content')
    {{-- <div class="d-flex flex-column align-items-center header-servicios"></div> --}}

    <div class="row text-center mb-5">
        <div class="col-12 pt-5 mb-4">
            <div class="text-dark mb-3 fw-bold">REPORTE DE CREDITO PREMIUN</div>
            <div class="mb-3">Estás viendo una vista previa de nuestros reportes para ver el tuyo debes adquirir un
                plan.</div>
        </div>

        <div class="col-12 d-flex gap-2 justify-content-center">
            <button class="btn btn-primary px-3 rounded-pill fw-bold" id="mostrarReportes">Ver mi informe
                crediticio</button>
            <button class="btn btn-primary px-3 rounded-pill fw-bold" id="mostrarMejoramientos">Mejorar mi score</button>
        </div>
    </div>

    {{-- Servicios de mejoramiento --}}
    @if (count($mejoramientos) > 0)
        <div id="mejoramientos" class="row row-cols-md-3 row-cols-1 pt-4 mb-4 d-none mx-4">
            @foreach ($mejoramientos as $plan)
                <div class="col mb-2">
                    <div class="card rounded-card h-100 gradiente-morado text-white">
                        {{-- Imagen --}}
                        <div class="card-body text-white">
                            {{-- <img class="w-100" src="{{ $plan->images?->url ?? url('img/logo.webp') }}" alt=""> --}}

                            {{-- Contenido --}}
                            <div class="w-100 text-white">
                                <h4 class="fw-bold text-center mb-4">{{ $plan->nombre }}</h4>
                                <div class="mb-2 gradiente-blanco rounded-card p-2 text-black">{!! $plan->descripcion !!}</div>

                                <div class="fs-4 text-center">
                                    {{ '$' . priceFormat($plan->precio_unitario + $plan->iva) }}</div>

                                @if ($plan->gravable)
                                    <div class="text-center">IVA incluido</div>
                                @else
                                    <div class="text-center">Precio final (No incluye IVA)</div>
                                @endif

                                <div class="text-center text-md-start my-3">
                                    <a href="{{ route('public.servicios.show', $plan) }}"
                                        class="btn btn-primary fw-bold px-3 rounded-pill my-3 w-100">Obtener ahora
                                        <i class="bi-chevron-right"></i></a>
                                    {{-- <a href="{{ $plan->url_destino }}" target="_blank"
                            class="btn btn-primary fw-bold px-3 rounded-pill w-100">Obtener ahora
                            <i class="bi-chevron-right"></i>
                        </a> --}}
                                    {{-- <a href="{{ route('planes.show', $plan) }}"
                            class="btn btn-success text-white w-100">Conocer
                            más</a> --}}
                                </div>
                                <div class="text-center">
                                    <i class="bi-bookmark-check-fill me-2 text-success"></i>TU COMPRA ES SEGURA
                                </div>
                            </div>
                        </div>

                        {{--
        </div> --}}
                        {{--
    </div> --}}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="ps-3 pt-3">Aún no se han agregado planes!</p>
    @endif

    {{-- Reportes --}}
    @if (count($reportes) > 0)
        <div id="reportes" class="row row-cols-md-3 row-cols-1 pt-4 mb-4 d-none mx-4">
            @foreach ($reportes as $plan)
                <div class="col mb-2">
                    <div class="card h-100 gradiente-azul-morado">
                        {{-- Imagen --}}
                        <div class="card-body">
                            {{-- <div class="text-center">
                                <img width="100px" class="mb-4" src="{{ $plan->images?->url ?? url('img/logo.webp') }}"
                                    alt="">
                            </div> --}}

                            {{-- Contenido --}}
                            <div class="w-100 text-white">
                                <h4 class="fw-bold text-center mb-4">{{ $plan->nombre }}</h4>
                                <div class="mb-2 gradiente-blanco rounded-card text-black p-2">{!! $plan->descripcion !!}</div>

                                <div class="fs-4 text-center">
                                    {{ '$' . priceFormat($plan->precio_unitario + $plan->iva) }}</div>

                                @if ($plan->gravable)
                                    <div class="text-center">IVA incluido</div>
                                @else
                                    <div class="text-center">Precio final (No incluye IVA)</div>
                                @endif

                                <div class="text-center text-md-start my-3">
                                    <a href="{{ route('public.servicios.show', $plan) }}"
                                            class="btn btn-primary fw-bold px-3 rounded-pill my-3 w-100">Obtener ahora
                                            <i class="bi-chevron-right"></i></a>
                                    {{-- <a href="{{ $plan->url_destino }}" target="_blank"
                                        class="btn btn-primary px-3 rounded-pill fw-bold w-100">Obtener ahora
                                    </a> --}}
                                </div>
                                <div class="text-center">
                                    <i class="bi-bookmark-check-fill me-2 text-success"></i>TU COMPRA ES SEGURA
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="ps-3 pt-3">Aún no se han agregado planes!</p>
    @endif

    <div id="app" class="px-5">
        <reporte-credito></reporte-credito>
    </div>

    <div class="row text-center pb-4">
        <div class="col-12 col-md-6 mx-auto">
            <a href="{{ route('public.servicios.index') }}" class="btn btn-primary fw-bold p-3 rounded-pill"
                id="mostrarPlanes">Conoce todos nuestros servicios
                <i class="bi-chevron-right"></i>
            </a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const mostrarMejoramientos = document.getElementById('mostrarMejoramientos');
        const mejoramientos = document.getElementById('mejoramientos');

        mostrarMejoramientos.addEventListener('click', () => {
            mejoramientos.classList.toggle('d-none')
        });

        const mostrarReportes = document.getElementById('mostrarReportes');
        const reportes = document.getElementById('reportes');

        mostrarReportes.addEventListener('click', () => {
            reportes.classList.toggle('d-none')
        });
    </script>
@endsection

@section('css')
    <style>
        .header-servicios {
            position: fixed;
            top: 130px;
            left: 0;
            /* padding-top: 10px; */
            height: 100vh;
            /* color: #fff; */
            width: 100%;
            z-index: -4;
            background-image: linear-gradient(to bottom, rgba(39, 48, 226, 0) 4%, rgba(0, 0, 0, 0) 60%), url("../img/bg.jpeg");
            /* background-image: linear-gradient(to bottom, rgba(39, 48, 226, 0.6) 4%, rgba(0, 0, 0, 1) 60%), url("../img/textura.png"); */
            background-repeat: no-repeat;
            background-position: bottom;
            background-attachment: fixed;
            background-size: cover;
            object-position: center;
            /* clip-path: polygon(100% 0, 100% 74%, 50% 100%, 0 74%, 0 0); */
        }

        .desenfoque {
            backdrop-filter: blur(10PX);
            background-color: #ffffff3e;
        }
    </style>
@endsection
