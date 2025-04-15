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

        <div class="row py-3 mb-3">
            <div class="col-12 col-md-6">
                <h6 class="mb-5 text-center">Score anterior</h6>
                <div class="py-4 mb-4 contador1">
                    <div class="color_fondo1"></div>
                    <div class="numero1"></div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h6 class="mb-5 text-center">Score mejorado</h6>
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
                <button class="btn btn-primary rounded-pill px-3 fw-bold" id="mostrarReportes">Ver mi informe crediticio</button>
                <button class="btn btn-primary rounded-pill px-3 fw-bold" id="mostrarMejoramientos">Mejorar mi score</button>
            </div>
        </div> --}}

        {{-- Reportes --}}
        @if (count($reportes) > 0)
            <h5 class="pt-4 text-blue">Conoce nuestros servicios</h5>
            <div id="reportes" class="row row-cols-md-4 row-cols-1 pt-4 mb-4">
                @foreach ($reportes as $plan)
                    <div class="col mb-2">
                        <div class="rounded-card gradiente-azul-morado text-white h-100">
                            {{-- Imagen --}}
                            <div class="card-body h-100">
                                <div class="text-center">
                                    <img width="100px" class="mb-4"
                                        src="{{ $plan->images?->url ?? url('img/logo.webp') }}" alt="">
                                </div>

                                {{-- Contenido --}}
                                <div class="w-100">
                                    <h4 class="fw-bold text-center mb-4">{{ $plan->nombre }}</h4>
                                    <div class="mb-4 text-black rounded-card bg-desenfoque p-2">{!! $plan->descripcion !!}
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
                                <img class="w-100 mb-4 rounded" src="{{ $plan->images?->url ?? url('img/logo.webp') }}"
                                    alt="">

                                {{-- Contenido --}}
                                <div class="w-100">
                                    <h4 class="fw-bold text-center mb-4">{{ $plan->nombre }}</h4>
                                    <div class="mb-4 text-black bg-desenfoque rounded-card p-2">{!! $plan->descripcion !!}</div>

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

        <h6 class="fw-bold text-center pt-4 mb-3">Segmentación del riesgo</h6>
        <table class="table mb-4">
            <thead>
                <tr>
                    <th>Segmentación</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color: #0cdd77">
                    <td>AAA - Cliente excelente</td>
                    <td>930 - 999 puntos</td>
                </tr>
                <tr style="background-color: #beff6f">
                    <td>AA - Cliente bueno</td>
                    <td>850 - 929</td>
                </tr>
                <tr style="background-color: #f7fee7">
                    <td>A - Cliente regular</td>
                    <td>700 - 849</td>
                </tr>
                <tr style="background-color: #fef200">
                    <td>B - Cliente bajo</td>
                    <td>400 - 699</td>
                </tr>
                <tr style="background-color: #ff0600">
                    <td>C - Cliente malo</td>
                    <td>Bajo 400</td>
                </tr>
            </tbody>
        </table>


        <h6 id="faq" class="fw-bold text-center py-4">Preguntas frecuentes</h6>
        <div class="card mb-2">
            <div class="card-body w-100 d-flex justify-content-between align-items-center cursor-pointer" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false"
                aria-controls="collapseExample1">
                <b>1. Crea tu historial crediticio</b>
                <i class="bi-chevron-down"></i>
            </div>
            <div class="collapse show" id="collapseExample1">
                <div class="px-3 pb-3 bg-white">
                    El historial crediticio se empieza a construir al momento de sacar un crédito, lo ideal es tener por lo
                    menos una línea de crédito. Esto puede ser a través de una tarjeta de crédito, un crédito directo en una
                    empresa o un crédito en una institución financiera, como un banco, cooperativa. El propósito es
                    demostrar que podemos cumplir con nuestros compromisos de pago, dado que, si no registramos operaciones
                    crediticias abiertas, las entidades no tienen información sobre nosotros para poder tomar una decisión.
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body w-100 d-flex justify-content-between align-items-center cursor-pointer" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false"
                aria-controls="collapseExample2">
                <b>2. Paga tus deudas a tiempo</b>
                <i class="bi-chevron-down"></i>
            </div>
            <div class="collapse show" id="collapseExample2">
                <div class="px-3 pb-3 bg-white">
                    Tener un sólido historial de pagar las deudas a tiempo crea un buen puntaje a lo largo del tiempo. En
                    tiempos pre-pandemia en Ecuador las deudas pasaban como vencidas a los 15 días de falta de pago; por
                    temas de pandemia hasta diciembre del 2021, las deudas pasarán como vencidas a los 61 días de falta de
                    pago. Mientras más tiempo pagues puntualmente tus deudas, mejor score tendrás.
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body w-100 d-flex justify-content-between align-items-center cursor-pointer" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false"
                aria-controls="collapseExample3">
                <b>3. Si tienes obligaciones vencidas ponte al día</b>
                <i class="bi-chevron-down"></i>
            </div>
            <div class="collapse show" id="collapseExample3">
                <div class="px-3 pb-3 bg-white">
                    Pagar tus deudas vencidas da una buena señal de tu compromiso de pago al sistema financiero y comercial.
                    Nunca es muy tarde para pagar una deuda, recuerda que los intereses se siguen acumulando y algo que
                    empezó como una deuda relativamente pequeña puede llegar a ser significativa si se deja acumular. Esto
                    refleja que en el pasado tuviste “errores” pero que tu conducta como sujeto de crédito está mejorando.
                </div>
            </div>
        </div>

        <div class="card mb-2">
            <div class="card-body w-100 d-flex justify-content-between align-items-center cursor-pointer" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="false"
                aria-controls="collapseExample4">
                <b>4. Mantén bajos los balances de tu tarjeta de crédito</b>
                <i class="bi-chevron-down"></i>
            </div>
            <div class="collapse show" id="collapseExample4">
                <div class="px-3 pb-3 bg-white">
                    Altos niveles de deuda pueden bajar tu score.
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body w-100 d-flex justify-content-between align-items-center cursor-pointer" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapseExample5" aria-expanded="false"
                aria-controls="collapseExample5">
                <b>5. Aplica a nuevas líneas de crédito solo cuando las necesitas</b>
                <i class="bi-chevron-down"></i>
            </div>
            <div class="collapse show" id="collapseExample5">
                <div class="px-3 pb-3 bg-white">
                    No podemos hacer huecos para tapar huecos, siempre nos van a quedar, ya sea huecos más grandes o huecos
                    sin tapar. Es decir, no podemos sacar nuevas líneas de crédito para pagar otras deudas, porque se
                    vuelven un ciclo vicioso.
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-12 col-md-6 mx-auto">
                <a href="{{ route('public.servicios.index') }}" class="btn btn-primary fw-bold p-3 rounded-pill"
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
            background-color: #f8f8f8;
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

        /**/

        .contador1 {
            height: 60px;
            width: 100%;
            transform: rotate(180deg);
            position: relative;
        }

        .numero1 {
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
            background-color: #f8f8f8;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .color_fondo1 {
            transition: .2s;
            transform-origin: bottom;
            position: absolute;
            display: block;
            height: 0%;
            width: 100%;
            background-color: #ff0600;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #ccc;
        }
    </style>
@endsection


@section('js')
    {{-- Contadores --}}
    <script>
        const color2 = document.getElementsByClassName('color_fondo2')[0]
        const numero2 = document.getElementsByClassName('numero2')[0]
        let cantidad2 = 0
        let tiempo2 = setInterval(() => {

            cantidad2 += 1

            if (cantidad2 <= 100) color2.style.height = `${cantidad2}%`
            numero2.textContent = cantidad2
            if (cantidad2 === 960) {
                clearInterval(tiempo2)
            }
        }, 40);

        const color1 = document.getElementsByClassName('color_fondo1')[0]
        const numero1 = document.getElementsByClassName('numero1')[0]
        let cantidad1 = 0
        let tiempo1 = setInterval(() => {

            cantidad1 += 1

            if (cantidad1 <= 100) color1.style.height = `${cantidad1}%`
            numero1.textContent = cantidad1
            if (cantidad1 === 250) {
                clearInterval(tiempo1)
            }
        }, 100);
    </script>

    {{-- Botones --}}
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
