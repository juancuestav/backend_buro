@extends('layouts.app')

@section('content')
    <div class="px-5 pt-4" style="margin-bottom: calc(100vh - 550px)">
        {{-- <div class="row d-flex align-items-center mx-auto scale-in g-0 w-75">
            <div class="col-md-4 px-4">
                <h5 class="text-fs-5em mb-4">Comenzar</h5>
                <h5 class="fs-4 letter-spacing-1px text-secondary mb-4">Adquiere nuestros planes y servicios</h5>
                <p class="fs-5 mb-4">Solicita tu crédito ágil, fácil y rápido. Contamos con convenio con diferentes instituciones financieras del pais.</p>

                <a class="btn btn-primary px-4 py-3 rounded-pill fw-bold" href="{{ route('contacto') }}">Contáctanos</a>
            </div>
            <div class="col-md-8">
                <img class="w-100 contactanos" src="{{ asset('img/contactanos.png') }}" alt="">
            </div>
        </div> --}}

        <div class="row py-3 mb-4">
            <div class="col-12 col-md-6">
                <x-contador titulo="¿Tu score crediticio es?" cantidad="23"></x-contador>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <!--<x-contador titulo="¿Tu score sobreendeudamiento es?"></x-contador>-->
                <h6 class="mb-5 text-center">¿Tu score sobreendeudamiento es?</h6>
                <div class="py-4 mb-4 contador2">
                    <div class="color_fondo2"></div>
                    <div class="numero2"></div>
                </div>
            </div>
            <small class="d-block text-center">Calculado por <b>Buró de Crédito Ecuador</b></small>
            <small class="d-block text-center">*Para conocer tu score crediticio debes adquirir un reporte o plan</small>
        </div>

        {{-- <div class="row text-center mb-5">
            <div class="col-12 col-md-6 mx-auto">
                <a href="#faq" class="text-dark d-block text-decoration-none mb-4 fw-bold">Preguntas frecuentes</a>
                <button class="btn btn-primary rounded-pill fw-bold px-3" id="mostrarReportes">Ver mi informe crediticio</button>
                <button class="btn btn-primary rounded-pill fw-bold px-3" id="mostrarMejoramientos">Mejorar mi score</button>
            </div>
        </div> --}}

        {{-- Reportes --}}
        @if (count($reportes) > 0)
            <h5 class="pt-4 text-blue">Conoce nuestros servicios</h5>
            <div id="reportes" class="row row-cols-md-4 row-cols-1 pt-4 mb-4">
                @foreach ($reportes as $plan)
                    <div class="col mb-2">
                        <div class="rounded-card h-100 gradiente-azul-morado text-white">
                            {{-- Imagen --}}
                            <div class="card-body h-100">
                                <div class="text-center">
                                    <img width="100px" class="mb-4"
                                        src="{{ $plan->images?->url ?? url('img/logo.webp') }}" alt="">
                                </div>

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
                                        <a href="{{ $plan->url_destino }}" target="_blank"
                                            class="btn btn-primary fw-bold w-100">Obtener ahora
                                        </a>
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
            {{--  @else
            <p class="ps-3 pt-3 text-white">Aún no se han agregado planes!</p> --}}
        @endif

        {{-- Servicios de mejoramiento --}}
        <h5 class="pt-4 text-morado">Conoce nuestros planes</h5>
        @if (count($mejoramientos) > 0)
            <div id="mejoramientos" class="row row-cols-md-3 row-cols-1 pt-4 mb-4">
                @foreach ($mejoramientos as $plan)
                    <div class="col mb-2">
                        <div class="rounded-card bg-morado text-white">
                            {{-- Imagen --}}
                            <div class="card-body">
                                <div class="text-center">
                                    <img width="100px" class="mb-4"
                                        src="{{ $plan->images?->url ?? url('img/logo.webp') }}" alt="">
                                </div>

                                {{-- Contenido --}}
                                <div class="w-100">
                                    <h4 class="fw-bold text-center mb-4">{{ $plan->nombre }}</h4>
                                    <div class="mb-4 text-black bg-desenfoque rounded-card p-2">{!! $plan->descripcion !!}
                                    </div>

                                    <div class="fs-4 fw-bold text-center">
                                        {{ '$' . priceFormat($plan->precio_unitario + $plan->iva) }}</div>

                                    @if ($plan->gravable)
                                        <div class="text-center">IVA incluido</div>
                                    @else
                                        <small class="d-block text-center">Precio final (No incluye IVA)</small>
                                    @endif

                                    <div class="text-center text-md-start my-3">
                                        <a href="{{ $plan->url_destino }}" target="_blank"
                                            class="btn btn-primary fw-bold w-100">Obtener ahora
                                        </a>
                                        {{-- <a href="{{ route('planes.show', $plan) }}" class="btn btn-success text-white w-100">Conocer
                                        más</a> --}}
                                    </div>
                                    <div class="text-center">
                                        <i class="bi-bookmark-check-fill me-2 text-success"></i>TU COMPRA ES SEGURA
                                    </div>
                                </div>
                            </div>

                            {{-- </div> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- @else
            <p class="ps-3 pt-3 text-white">Aún no se han agregado planes!</p> --}}
        @endif



        <h6 id="faq" class="text-center pt-4 fw-bold pb-3">Preguntas frecuentes</h6>
        <div class="card mb-2">
            <div class="card-body w-100 d-flex justify-content-between align-items-center cursor-pointer" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false"
                aria-controls="collapseExample1">
                <b>¿Qué es score de crédito?</b>
                <i class="bi-chevron-down"></i>
            </div>
            <div class="collapse show" id="collapseExample1">
                <div class="px-3 pb-3 bg-white">
                    El score crediticio es un puntaje calculado en base a la información reportada por distintas
                    entidades a
                    los burós de información crediticia, entre la que consta tu record de pagos, tu monto de
                    endeudamiento y
                    la antigüedad de tu historial de crédito. El score calculado por BURO DE CREDITO ECUADOR tiene un
                    rango
                    que va desde 1 a 999. El score crediticio es una de las varias herramientas utilizadas por las
                    instituciones para poder determinar qué tan factible es recuperar el crédito que otorgan. Mientras
                    más
                    alto sea tu score significa que has mostrado un comportamiento responsable en el cumplimiento de tus
                    obligaciones, y esto permite a las instituciones evaluar con mayor confianza futuras solicitudes de
                    crédito. Es importante recalcar que la situación de cada individuo es distinta, y por ese motivo el
                    score crediticio es solo uno de los factores que se utilizan para evaluar la capacidad de pago del
                    aplicante.
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body w-100 d-flex justify-content-between align-items-center cursor-pointer" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false"
                aria-controls="collapseExample2">
                <b>¿Qué factores inciden sobre mi score crediticio y como lo puedo mejorar?</b>
                <i class="bi-chevron-down"></i>
            </div>
            <div class="collapse show" id="collapseExample2">
                <div class="px-3 pb-3 bg-white">
                    Toda información reportada a los burós de información crediticia incide sobre el cálculo de tu
                    score, para mantenerlo en óptima situación te recomendamos cumplir con el pago puntual de todos tus
                    compromisos, tanto los comerciales como los financieros.
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body w-100 d-flex justify-content-between align-items-center cursor-pointer" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false"
                aria-controls="collapseExample3">
                <b>¿Cuáles son los beneficios al adquirir el reporte completo?</b>
                <i class="bi-chevron-down"></i>
            </div>
            <div class="collapse show" id="collapseExample3">
                <div class="px-3 pb-3 bg-white">
                    Analizar la probabilidad de obtener financiamiento. Conocer qué factores te pueden ayudar a mejorar
                    tu score crediticio. Conocer el detalle de la información reportada a BURO DE CREDITO ECUADOR
                    Identificar si tienes obligaciones que afecten tu historial crediticio.
                </div>
            </div>
        </div>

        <div class="card mb-5">
            <div class="card-body w-100 d-flex justify-content-between align-items-center cursor-pointer" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="false"
                aria-controls="collapseExample4">
                <b>¿Qué contiene el reporte completo?</b>
                <i class="bi-chevron-down"></i>
            </div>
            <div class="collapse show" id="collapseExample4">
                <div class="px-3 pb-3 bg-white">
                    Indicador gráfico para analizar los cambios en tu perfil crediticio de los últimos 12 meses
                    Visibilidad de las obligaciones vigentes y de las históricas de hasta 36 meses de antigüedad. Código
                    QR que permite verificar la validez de la información del reporte. Tengo dudas acerca del reporte
                    Para mayor información puedes acercarte al Centro de Atención al cliente ubicado en:
                    Guayaquil: Av. LOS RIOS #609 & QUISQUIS, Edificio ORELLANA PISO 3 OF5. Correo electrónico:
                    atencionclientes@burodecredito.ec Teléfono
                    convencional (04)5039470
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-12 col-md-6 mx-auto">
                <a href="{{ route('public.servicios.index') }}" class="btn btn-primary p-3 fw-bold rounded-pill"
                    id="mostrarPlanes">Conoce todos nuestros servicios
                    <i class="bi-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .header-planes {
            position: absolute;
            top: 0;
            left: 0;
            padding-top: 10px;
            height: 400px;
            color: #fff;
            width: 100%;
            z-index: -4;
            background-image: linear-gradient(to bottom, rgba(39, 48, 226, 0) 4%, rgba(0, 0, 0, 0) 60%), url("../img/bg.jpeg");
            background-repeat: no-repeat;
            background-position: bottom;
            background-attachment: fixed;
            background-size: cover;
            object-position: center;
            clip-path: polygon(100% 0, 100% 74%, 50% 100%, 0 74%, 0 0);
        }

        .header-planes>* {
            z-index: 50;
        }

        .header-planes i {
            padding: 8px;
            color: #ffffff99;
        }

        .header-planes::before {
            position: absolute;
            content: "";
            z-index: 10;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .cuadrado {
            background-color: #7aa815;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            color: #fff;
            border-radius: 8px;
            padding: 8px 18px;
            margin-top: 96px;
            display: inline-block;
        }

        .borde-rounded {
            border-radius: 4px;
        }
    </style>

    <style>
        .contador2 {
            height: 60px;
            width: 100%;
            transform: rotate(180deg);
            position: relative;
        }

        .numero2 {
            height: 100%;
            width: 100%;
            text-align: center;
            font-size: 60px;
            font-weight: bold;
            font-family: sans-serif;
            color: #000;
            position: absolute;
            transform: rotate(-180deg);
            mix-blend-mode: screen;
            /* background-color: #fff; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .color_fondo2 {
            transition: .2s;
            transform-origin: bottom;
            position: absolute;
            display: block;
            height: 0%;
            width: 100%;
            background-color: #7aa815;
        }
    </style>
@endsection


@section('js')
    <script>
        const color2 = document.getElementsByClassName('color_fondo2')[0]
        const numero2 = document.getElementsByClassName('numero2')[0]
        let cantidad2 = 0
        let tiempo2 = setInterval(() => {

            cantidad2 += 1

            // if (cantidad2 <= 100) color2.style.height = `${cantidad2}%`
            numero2.textContent = cantidad2
            if (cantidad2 === 999) {
                cantidad2 = 1;
            }
        }, 100);
    </script>

    <script>
        const mostrarMejoramientos = document.getElementById('mostrarMejoramientos');
        const mejoramientos = document.getElementById('mejoramientos');

        mostrarMejoramientos.addEventListener('click', () => {
            mejoramientos.classList.toggle('d-none')
        });

        const mostrarPlanes = document.getElementById('mostrarReportes');
        const reportes = document.getElementById('reportes');

        mostrarReportes.addEventListener('click', () => {
            reportes.classList.toggle('d-none')
        });
    </script>
@endsection
