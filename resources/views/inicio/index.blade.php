@extends('layouts.app')

@section('content')
    {{-- <x-carousel></x-carousel> --}}

    {{-- Seccion 1 --}}
    <div class="row d-flex align-items-center p-4 scale-in g-0 w-7d5 mx-auto">
        <div class="col-12 text-center mb-4">
            <h5 class="fw-bold fs-6 letter-spacing-1px text-black mb-4">BURÓ DE CRÉDITO ECUADOR</h5>
            {{-- <p class="text-fs-5em fw-bold mb-4">Buró de crédito Ecuador</p> --}}
            <a class="btn text-white rounded-pill fw-bold px-4 py-3 mb-2 d-inline-block" style="background-color: #003dff"
                href="{{ route('soluciones-empresas') }}"><i class="bi bi-stars"></i> Soluciones empresas
            </a>

            <a class="btn btn-light text-secondary rounded-pill fw-bold px-4 py-3 mb-2 d-inline-block" target="_blank"
                href="https://play.google.com/store/apps/details?id=org.capacitor.quasar.buroecuador&pcampaignid=web_share"><i
                    class="bi bi-google-play"></i> Descarga nuestra App móvil
            </a>

            <a class="btn gradiente-azul-morado text-white rounded-pill fw-bold px-4 py-3 mb-2 d-inline-block"
                href="{{ route('solicitud_credito.index') }}"><i class="bi bi-credit-card"></i> Solicitud de crédito
            </a>

            <a class="btn bg-whatsapp text-white rounded-pill fw-bold px-4 py-3 mb-2 d-inline-block" target="_blank"
                href="https://api.whatsapp.com/send?phone=593995679225&text=Buen%20d%C3%ADa%2C%20quiero%20consultar%20el%20estado%20de%20mi%20solicitud%20de%20cr%C3%A9dito%20"><i
                    class="bi bi-whatsapp"></i>{{ ' Consultar estado de solicitud de crédito' }}
            </a>
        </div>
        {{-- <div class="col-md-8">
            <img class="w-100" src="{{ asset('img/buro_portada.png') }}" alt="">
        </div> --}}
    </div>

    <div class="bg-morado text-white py-4">
        <div class="container">
            <h4 class="text-thin d-inline-block">El</h4>
            <h4 class="d-inline-block">80% DE LOS USUARIOS</h4>
            <h4 class="text-thin d-inline-block">de</h4>
            <h4 class="d-inline-block">Buró de Crédito Ecuador</h4>
            <h4 class="text-thin d-inline-block">vieron un</h4>
            <h4 class="bg-primary text-morado d-inline-block">IMPACTO POSITIVO</h4>
            <h4 class="d-inline-block text-thin">en su vida financiera.</h4>
        </div>
    </div>

    <div class="p-2">
        <reporte-credito></reporte-credito>

        <div class="my-3 mb-4">
            <h5 class="text-center">¿Cansado de estar en central de riesgo?</h5>
            <h5 class="text-center">¿No te dan crédito en los bancos?</h5>
            <h5 class="text-center">¿Nadie puede ayudarte?</h5>
        </div>
        {{-- <div class="leftToRightAnimation">
        <p class="text-center fs-4">Nosotros sí podemos, te ayudamos a aumentar tu puntaje.</p>
        <p><i class="bi-check-circle-fill text-success me-2"></i>Revisamos tu buró de crédito y te damos
            asesoría
            financiera y comercial.</p>
        <p><i class="bi-check-circle-fill text-success me-2"></i>Revisamos tu historial crediticio de los
            últimos
            tres años, tu capacidad de endeudamiento</p>
        <p><i class="bi-check-circle-fill text-success me-2"></i>Revisamos si tienes tarjeta o crédito
            preaprobado
            en todas las entidades financieras.</p>
    </div> --}}
        <div class="row leftToRightAnimation w-75 mx-auto g-md-5 g-2 mb-4">
            <div class="col-md-4">
                <div class="rounded-card h-100 bg-orange text-morado row p-3">
                    <div class="col-10 col-md-11 h-100">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="card-title">¿Conoces tu historia de crédito?</h4>
                            <span>Regístrate y conoce tus reportes en </span><b>Buró de Crédito
                                Ecuador.</b>
                        </div>
                    </div>
                    <div
                        class="col-2 col-md-1 h-100 bg-desenfoque rounded-card d-flex align-items-center justify-content-center">
                        <a target="_blank" href="https://app.burodecredito.ec/register">
                            <i class="bi-chevron-right fs-4 p-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rounded-card h-100 bg-blue text-white row p-3">
                    <div class="col-10 col-md-11 h-100">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="card-title">¿Buscas el crédito perfecto para ti?</h4>
                            <span>Encuentra con nuestros aliados <b>OFERTAS</b> ajustadas a tu perfil financiero.</span>
                        </div>
                    </div>
                    <div
                        class="col-2 col-md-1 h-100 bg-desenfoque rounded-card d-flex align-items-center justify-content-center">
                        <a target="_blank" href="https://app.burodecredito.ec/register">
                            <i class="bi-chevron-right fs-4 p-1 text-blue"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rounded-card h-100 bg-pink text-white row p-3">
                    <div class="col-10 col-md-11 h-100">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="card-title">¿Tienes deudas pendientes?</h4>
                            <span><b>NEGOCIA</b> y <b>PAGA</b> tus deudas con nuestros aliados de forma rápida y
                                sencilla.</span>
                        </div>
                    </div>
                    <div
                        class="col-2 col-md-1 h-100 bg-desenfoque rounded-card d-flex align-items-center justify-content-center">
                        <a target="_blank" href="https://app.burodecredito.ec/register">
                            <i class="bi-chevron-right fs-4 p-1 text-pink"></i>
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="rounded-card text-white h-100 bg-blue">
                    <div class="px-4 d-flex flex-column align-items-center text-center">
                        <i class="bi-check-circle text-success fs-1"></i>
                        <h5 class="card-title">Revisamos tu historial crediticio de los últimos tres años, tu capacidad de
                            endeudamiento</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rounded-card text-white h-100 bg-pink">
                    <div class="px-4 d-flex flex-column align-items-center text-center">
                        <i class="bi-check-circle text-success fs-1"></i>
                        <h5 class="card-title">Revisamos si tienes tarjeta o crédito preaprobado en todas las entidades
                            financieras.</h5>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    @include('inicio.inicio-seccion2')

    @include('inicio.testimonials')

    {{-- Seccion 2 --}}
    <div class="row d-flex align-items-center mx-auto scale-in g-0 w-75">
        <div class="col-md-6">
            <h5 class="fs-2 mb-4">¿Qué es el Buró de crédito?</h5>
            <p class="mb-4 text-justify">Se trata de una entidad privada que genera informes del historial de crédito de
                personas o empresas,
                en
                donde se incluye información relacionada al comportamiento de pagos de créditos hipotecarios o
                automotrices, cuentas de tarjetas de crédito o servicios básicos como luz o agua, entre otros.
                Toda la información que se encuentra en el Buró de Crédito es confidencial, siendo compartida a
                entidades financieras afiliadas que la soliciten. Por ejemplo, si quieres obtener una tarjeta de
                crédito, un préstamo o un crédito hipotecario, el banco pedirá tu reporte al Buró de Crédito para
                evaluar si cumples con los requisitos necesarios. Como persona, también puedes acceder a un reporte
                de
                crédito especial, que puedes obtener de forma gratuita una vez al año para conocer tu historial
                crediticio, saber quién lo consulta y comprobar que tu información se encuentre correcta y
                actualizada.
                Por lo mismo, estar registrado en el Buró de Crédito tendrá efectos positivos dependiendo del
                comportamiento de pagos que tengas. Si no cuentas con un historial, te será más complejo obtener o
                contratar cualquier tipo de producto financiero.</p>

            <a class="btn btn-primary text-morado px-4 py-3 rounded-pill fw-bold no-wrap"
                href="{{ route('public.servicios.index') }}">Adquiere
                tu informe de crédito
                aquí <i class="bi-chevron-right"></i></a>
        </div>
        <div class="col-md-6">
            <img class="w-100" src="{{ asset('img/img1.png') }}" alt="">
        </div>
    </div>

    {{-- Seccion 3 --}}
    <div class="scale-in">
        <div class="row d-flex align-items-center g-0 w-75 mx-auto">
            <div class="col-md-6">
                <img class="w-100" src="{{ asset('img/img2.png') }}" alt="">
            </div>
            <div class="col-md-6">
                <h5 class="f-2 mb-4">¿Cómo funciona?</h5>
                <p class="mb-4 text-justify">
                    Puesto que el Buró de Crédito es una instancia netamente informativa, solo se encarga de reunir
                    datos, los que va acumulando en el tiempo para generar "Mi Score" o indicador numérico, el cual se
                    encuentra entre los 400 y 850 puntos. Esta entidad evalúa tu comportamiento crediticio, el cual es
                    dinámico y cambia en el tiempo según el cumplimiento que tengas de tus obligaciones financieras.
                    Finalmente, es importante considerar que, si en algún momento dejas de pagar o te atrasas en los
                    pagos, tu puntuación e historial se verán afectados. Por ello, si existe alguna circunstancia que te
                    impide cumplir con tus obligaciones financieras, es recomendable que regularices tu situación a la
                    brevedad, por ejemplo, contactándote con las instituciones en las cuales figuras como deudor y
                    consultar las opciones para planificar los pagos pendientes.</p>
                <a class="btn btn-primary text-morado px-4 py-3 mb-4 rounded-pill fw-bold no-wrap"
                    href="{{ route('public.servicios.index') }}">Adquiere tu informe de crédito
                    ahora <i class="bi-chevron-right"></i></a>
            </div>

            <div class="col-12 text-center mb-4">
                <h5 class="fw-bold fs-6 letter-spacing-1px text-black mb-4">BURÓ DE CRÉDITO ECUADOR</h5>
                {{-- <p class="text-fs-5em fw-bold mb-4">Buró de crédito Ecuador</p> --}}

                <a class="btn text-white rounded-pill fw-bold px-4 py-3 mb-2 d-inline-block"
                    style="background-color: #003dff" href="{{ route('soluciones-empresas') }}"><i class="bi bi-stars"></i>
                    Soluciones empresas
                </a>

                <a class="btn btn-light text-secondary rounded-pill fw-bold px-4 py-3 mb-2 d-inline-block" target="_blank"
                    href="https://play.google.com/store/apps/details?id=org.capacitor.quasar.buroecuador&pcampaignid=web_share"><i
                        class="bi bi-google-play"></i> Descarga nuestra App móvil
                </a>

                <a class="btn gradiente-azul-morado text-white rounded-pill fw-bold px-4 py-3 mb-2 d-inline-block"
                    href="{{ route('solicitud_credito.index') }}"><i class="bi bi-credit-card"></i> Solicitud de crédito
                </a>

                <a class="btn bg-whatsapp text-white rounded-pill fw-bold px-4 py-3 mb-2 d-inline-block" target="_blank"
                    href="https://bit.ly/4kiE1BW"><i
                        class="bi bi-whatsapp"></i>{{ ' Consultar estado de solicitud de crédito' }}
                </a>
            </div>
        </div>
    </div>

    {{-- <div class="bg-black">
        <div class="row d-flex align-items-center g-0 w-75 mx-auto">
            <div class="col-md-6">
                <img class="w-75 celular" src="{{ asset('img/movil.png') }}" alt="">
            </div>
            <div class="col-md-6 px-4">
                <h5 class="text-fs-5em mb-4 text-white">Conoce nuestra aplicación móvil</h5>
                <p class="text-light fs-4 mb-4">
                    Accede a todos los planes y servicios a través de nuestra aplicación móvil actualmente disponible para
                    dispositivos Android.</p>
                <a class="btn btn-primary text-white px-4 py-3 rounded-pill fw-bold" target="_blank"
                    href="https://play.google.com/store/apps/details?id=org.capacitor.quasar.buroecuador&pcampaignid=web_share">Descarga
                    nuestra App
                    móvil</a>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row d-flex align-items-center mx-auto scale-in g-0 w-75">
        <div class="col-md-4 px-4">
            <h5 class="text-fs-5em mb-4">Comenzar</h5>
            <h5 class="fs-4 letter-spacing-1px text-secondary mb-4">Adquiere nuestros planes y servicios</h5>
            <p class="fs-5 mb-4">Solicita tu crédito ágil, fácil y rápido. Contamos con convenio con diferentes
                instituciones financieras del pais.</p>

            <a class="btn btn-primary text-white px-4 py-3 rounded-pill fw-bold"
                href="{{ route('contacto') }}">Contáctanos</a>
        </div>
        <div class="col-md-8">
            <img class="w-100 contactanos" src="{{ asset('img/contactanos.png') }}" alt="">
        </div>
    </div> --}}

    {{-- Seccion 4 --}}
    {{-- <div id="planes" class="container text-center mb-4 pt-5">
    <h4 class="d-inline-block border-bottom border-success border-2 pb-2">Planes</h4>
</div>
<div class="row row-cols-md-3 row-cols-1 mb-5 g-0">
    <div class="col contenedor-card bottomToTopRotateAnimation">
        <img class="w-100" src="{{ asset('img/plan_basic.jpeg') }}" alt="">
    </div>
    <div class="col contenedor-card bottomToTopRotateAnimation">
        <img class="w-100" src="{{ asset('img/plan_premium.jpeg') }}" alt="">
    </div>
    <div class="col contenedor-card bottomToTopRotateAnimation">
        <img class="w-100" src="{{ asset('img/plan_estandar.jpeg') }}" alt="">
    </div>
</div> --}}

    {{-- <div class="row g-0 py-5">
    <div class="col-12 text-center">
        <p class="fs-4">¿Deseas obtener más información?</p> <a class="btn btn-primary"
            href="{{ route('contacto') }}">Contáctanos</a>
    </div>
</div> --}}

    <!-- Modal popup -->
    @if (count($popups))
        <x-popup :popups="$popups"></x-popup>
    @endif
@endsection

@section('js')
    {{-- Contador --}}
    <script>
        const color = document.getElementById('fondo_color')
        const numero = document.getElementById('numero')
        const contador = document.getElementById('contador').value

        let cantidad = 0
        let tiempo = setInterval(() => {
            cantidad += 1

            if (cantidad <= 100) color.style.height = `${cantidad}%`
            numero.textContent = cantidad
            if (cantidad > contador) {
                clearInterval(tiempo)
            }
        }, 4);
    </script>
@endsection

@section('css')
    <style>
        .planes {
            border-bottom: 2px dashed #1f1f1f;
            display: inline-block;
        }
    </style>

    {{-- Contador --}}
    <style>
        .contador {
            height: 60px;
            width: 100%;
            transform: rotate(180deg);
            position: relative;
        }

        .numero {
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
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .color_fondo {
            transition: .2s;
            transform-origin: bottom;
            position: absolute;
            display: block;
            height: 0%;
            width: 100%;
            background-color: #7aa815;
        }

        .celular {
            position: relative;
            bottom: -60px;
        }

        .contactanos {
            position: relative;
            left: -100px;
        }

        .bg-whatsapp {
            background-color: #3ec13a;
        }
    </style>
@endsection
