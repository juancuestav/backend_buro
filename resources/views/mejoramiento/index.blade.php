@extends('layouts.app')

@section('content')
    <div class="px-5 pt-4" style="margin-bottom: calc(100vh - 550px)">


        {{-- Servicios de mejoramiento --}}
        {{--   <h5 class="pt-4 text-morado">Conoce nuestros planes</h5> --}}
        <div class="section-header">
            <h2 class="section-title mb-2">Conoce nuestros planes de mejoramiento</h2>
        </div>
        @if (count($mejoramientos) > 0)
            <div id="mejoramientos" class="row row-cols-md-3 row-cols-1 pt-4 mb-4">
                @foreach ($mejoramientos as $plan)
                    <div class="col mb-2">
                        <div class="p-3 rounded-card gradiente-azul-morado text-white">
                            {{-- Imagen --}}
                            <div class="card-body">
                                {{-- <img class="w-100 mb-4 rounded" src="{{ $plan->images?->url ?? url('img/logo.webp') }}"
                                    alt=""> --}}

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
                                        <a href="{{ route('public.servicios.show', $plan) }}"
                                            class="btn btn-primary fw-bold px-3 rounded-pill my-3 w-100">Obtener ahora
                                            <i class="bi-chevron-right"></i></a>
                                        {{-- <a href="{{ $plan->url_destino }}" target="_blank"
                                            class="btn btn-primary fw-bold w-100">Obtener ahora
                                        </a> --}}
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

        <!-- Risk Segmentation Section -->
        <section class="risk-section">
            <div class="section-header">
                <h2 class="section-title mb-4">Segmentación del riesgo</h2>
                <div class="section-divider"></div>
            </div>

            <div class="risk-table-container">
                <div class="risk-table">
                    <div class="risk-row risk-aaa">
                        <div class="risk-label">
                            <span class="risk-grade">AAA</span>
                            <span class="risk-desc">Cliente excelente</span>
                        </div>
                        <div class="risk-score">930 - 999 puntos</div>
                    </div>
                    <div class="risk-row risk-aa">
                        <div class="risk-label">
                            <span class="risk-grade">AA</span>
                            <span class="risk-desc">Cliente bueno</span>
                        </div>
                        <div class="risk-score">850 - 929</div>
                    </div>
                    <div class="risk-row risk-a">
                        <div class="risk-label">
                            <span class="risk-grade">A</span>
                            <span class="risk-desc">Cliente regular</span>
                        </div>
                        <div class="risk-score">700 - 849</div>
                    </div>
                    <div class="risk-row risk-b">
                        <div class="risk-label">
                            <span class="risk-grade">B</span>
                            <span class="risk-desc">Cliente bajo</span>
                        </div>
                        <div class="risk-score">400 - 699</div>
                    </div>
                    <div class="risk-row risk-c">
                        <div class="risk-label">
                            <span class="risk-grade">C</span>
                            <span class="risk-desc">Cliente malo</span>
                        </div>
                        <div class="risk-score">Bajo 400</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section mb-4 py-5 bg-light" id="faq">
            <div class="container">
                <div class="section-header text-center mb-5">
                    <h2 class="section-title mb-3">Preguntas frecuentes</h2>
                    <div class="section-divider mx-auto"></div>
                </div>

                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="accordion custom-accordion" id="faqAccordion">
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="faq1">
                                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        1. Crea tu historial crediticio
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        El historial crediticio se empieza a construir al momento de sacar un crédito, lo
                                        ideal es tener por lo
                                        menos una línea de crédito. Esto puede ser a través de una tarjeta de crédito, un
                                        crédito directo en una
                                        empresa o un crédito en una institución financiera, como un banco, cooperativa. El
                                        propósito es
                                        demostrar que podemos cumplir con nuestros compromisos de pago, dado que, si no
                                        registramos operaciones
                                        crediticias abiertas, las entidades no tienen información sobre nosotros para poder
                                        tomar una decisión.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="faq2">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false"
                                        aria-controls="collapse2">
                                        2. Paga tus deudas a tiempo
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Tener un sólido historial de pagar las deudas a tiempo crea un buen puntaje a lo
                                        largo del tiempo. En
                                        tiempos pre-pandemia en Ecuador las deudas pasaban como vencidas a los 15 días de
                                        falta de pago; por
                                        temas de pandemia hasta diciembre del 2021, las deudas pasarán como vencidas a los
                                        61 días de falta de
                                        pago. Mientras más tiempo pagues puntualmente tus deudas, mejor score tendrás.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="faq3">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false"
                                        aria-controls="collapse3">
                                        3. Si tienes obligaciones vencidas ponte al día
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Pagar tus deudas vencidas da una buena señal de tu compromiso de pago al sistema
                                        financiero y comercial.
                                        Nunca es muy tarde para pagar una deuda, recuerda que los intereses se siguen
                                        acumulando y algo que
                                        empezó como una deuda relativamente pequeña puede llegar a ser significativa si se
                                        deja acumular. Esto
                                        refleja que en el pasado tuviste “errores” pero que tu conducta como sujeto de
                                        crédito está mejorando.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="faq4">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false"
                                        aria-controls="collapse4">
                                        4. Mantén bajos los balances de tu tarjeta de crédito
                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Altos niveles de deuda pueden bajar tu score.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="faq4">
                                    <button class="accordion-button collapsed fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false"
                                        aria-controls="collapse4">
                                        5. Aplica a nuevas líneas de crédito solo cuando las necesitas
                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        No podemos hacer huecos para tapar huecos, siempre nos van a quedar, ya sea huecos
                                        más grandes o huecos
                                        sin tapar. Es decir, no podemos sacar nuevas líneas de crédito para pagar otras
                                        deudas, porque se
                                        vuelven un ciclo vicioso.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
        /* FAQ Section */
        .custom-accordion .accordion-item {
            border: none;
            box-shadow: var(--shadow-soft);
            border-radius: 16px;
            overflow: hidden;
        }

        .custom-accordion .accordion-button {
            background: white;
            border: none;
            color: #443462;
            font-weight: 600;
            padding: 1.5rem;
            border-radius: 16px;
        }

        .custom-accordion .accordion-button:not(.collapsed) {
            background: #443462;
            color: white;
            box-shadow: none;
        }

        .custom-accordion .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(68, 52, 98, 0.25);
        }

        .custom-accordion .accordion-body {
            padding: 1.5rem;
            color: #666;
            line-height: 1.7;
        }

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

        /* Risk Section */
        .risk-section {
            margin-bottom: 80px;
        }

        .risk-table-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .risk-table {
            display: flex;
            flex-direction: column;
        }

        .risk-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 30px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .risk-row:last-child {
            border-bottom: none;
        }



        .risk-label {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .risk-grade {
            font-weight: 700;
            font-size: 1.2rem;
            padding: 2px 12px;
            border-radius: 8px;
            background: white;
            color: var(--dark-color);
            min-width: 50px;
            text-align: center;
        }

        .risk-desc {
            font-weight: 600;
            color: var(--dark-color);
        }

        .risk-score {
            font-weight: 600;
            color: var(--dark-color);
            font-size: 1.1rem;
        }

        .risk-aaa {
            background: linear-gradient(135deg, #0cdd77, #00b359);
        }

        .risk-aa {
            background: linear-gradient(135deg, #beff6f, #9fd650);
        }

        .risk-a {
            background: linear-gradient(135deg, #f7fee7, #e8f5c8);
        }

        .risk-b {
            background: linear-gradient(135deg, #fef200, #e6d900);
        }

        .risk-c {
            background: linear-gradient(135deg, #ff0600, #cc0500);
        }

        .risk-c .risk-desc,
        .risk-c .risk-score {
            color: white;
        }
    </style>
@endsection


@section('js')
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
