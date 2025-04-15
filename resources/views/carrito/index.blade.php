@extends('layouts.app')

@section('content')
    <div class="row py-4" style="margin: 0 16px calc(100vh - 550px) 16px">
        {{-- Columna 1 --}}
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="d-flex justify-content-between pt-4 px-4">
                    <h2 class="fs-6 fw-bold mb-4"><i class="bi-cart-fill me-2"></i>
                        Adquirir servicio
                    </h2>
                </div>
                <div class="mx-2">
                    <div class="row px-2">
                        {{-- Imagen --}}
                        <img class="w-100 mb-4" src="{{ $servicio->images?->url ?? url('img/logo.webp') }}" alt=""
                            style="object-fit: cover">

                        {{-- Detalles --}}
                        <div class="col-12">
                            <span class="fw-bold">{{ $servicio->nombre }}</span><br>
                            <small class="text-success d-block mb-3">Disponible</small>
                            <span class="">{!! $servicio->descripcion !!}</span><br>
                        </div>

                        {{-- Precio --}}
                        <div class="col-12 text-center mb-4">
                            <span id="{{ 'input_precio' }}" class="fw-bold fs-4 d-block">$
                                {{ priceFormat($servicio->precio_unitario + $servicio->iva) }}</span>
                                @if($servicio->gravable)
                                <div class="text-center">IVA incluido</div>
                                @else
                                <div class="text-center">Precio final (No incluye IVA)</div>
                                @endif
                        </div>
                        @if ($servicio->url_video)
                            <div class="col-12 text-center mb-4">
                                <iframe src="{{ $servicio->url_video }}" title="YouTube video player" frameborder="0"
                                    class="w-100"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                        <div class="text-center mb-4">
                            <i class="bi-bookmark-check-fill me-2 text-success"></i>TU COMPRA ES SEGURA
                        </div>
                        <input type="hidden" name="whatsapp" value="{{ Config::get('buro.whatsapp') }}">

                        <div id="boton-whatsapp"></div>
                        {{-- <button class="btn btn-success text-white mb-4">
                            <i class="bi-whatsapp me-2"></i> {{ __('¿Necesitas ayuda?') }}
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Columna 2 --}}
        <div class="col-md-8">
            <div class="card card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('public.servicios.store') }}">
                    @csrf

                    <input type="hidden" name="servicio" value="{{ $servicio->id }}">

                    <div class="row">
                        <div class="col-12 py-2">
                            <h1 class="text-center fs-6 fw-bold mb-4">Buró de Crédito Ecuador</h1>
                        </div>
                        {{-- Nombre --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>

                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus
                                placeholder="Ingrese su nombre">

                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Apellidos --}}
                        {{-- <div class="col-lg-6 col-md-12 mb-4">
                            <label for="apellidos" class="form-label">{{ __('Apellidos') }}</label>

                            <input id="apellidos" type="text"
                                class="form-control @error('apellidos') is-invalid @enderror" name="apellidos"
                                value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus
                                placeholder="Ingrese sus apellidos">

                            @error('apellidos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        {{-- Fecha de nacimiento --}}
                        {{-- <div class="col-lg-6 col-md-12 mb-4">
                            <label for="edad" class="form-label">{{ __('Edad') }}</label>

                            <input id="edad" type="number" class="form-control @error('edad') is-invalid @enderror"
                                name="edad" value="{{ old('edad') }}" autocomplete="edad" autofocus required
                                placeholder="Ingrese su edad">

                            @error('edad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        {{-- Provincia --}}
                        {{-- <div class="col-lg-6 col-md-12 mb-4">
                            <label for="provincia" class="form-label">Provincia</label>
                            <select id="selector_provincias" name="provincia" class="form-select form-control">
                                @foreach ($provincias as $provincia)
                                    <option value="{{ $provincia->id }}" @if ($provincia->id == old('provincia')) selected @endif>
                                        {{ $provincia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provincia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        {{-- Ciudad --}}
                        {{-- <div class="col-lg-6 col-md-12 mb-4">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <select name="ciudad" class="form-select form-control" id="selector_ciudades">
                                @foreach ($ciudades as $ciudad)
                                    <option value="{{ $ciudad->id }}" @if ($ciudad->id == old('ciudad')) selected @endif>
                                        {{ $ciudad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ciudad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        {{-- Direccion --}}
                        {{-- <div class="col-lg-6 col-md-12 mb-4">
                            <label for="direccion" class="form-label">{{ __('Dirección') }}</label>

                            <input id="direccion" type="text"
                                class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                                value="{{ old('direccion') }}" autocomplete="direccion" autofocus
                                placeholder="Ingrese su dirección">

                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        {{-- Celular --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="celular" class="form-label">{{ __('Celular') }}</label>

                            <input id="celular" type="text"
                                class="form-control @error('celular') is-invalid @enderror" name="celular"
                                value="{{ old('celular') }}" required autocomplete="celular" autofocus
                                placeholder="Ingrese su número celular">

                            @error('celular')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Correo --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="correo" class="form-label">{{ __('Correo') }}</label>

                            <input id="correo" type="email"
                                class="form-control @error('correo') is-invalid @enderror" name="correo"
                                value="{{ old('email') }}" required autocomplete="correo"
                                placeholder="Ingrese su correo electrónico">

                            @error('correo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Tipo identificacion --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="document_type" class="form-label">Tipo de identificación</label>
                            <select name="tipo_identificacion" class="form-select form-control" id="tipo_identificacion">
                                @foreach ($tipos_identificaciones as $type)
                                    <option value="{{ $type->id }}" @if ($type->id == old('tipo_identificacion')) selected @endif>
                                        {{ $type->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_identificacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Identificacion --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="identificacion" class="form-label">{{ __('Identificación') }}</label>

                            <input id="identificacion" type="text"
                                class="form-control @error('identificacion') is-invalid @enderror" name="identificacion"
                                value="{{ old('identificacion') }}" required autocomplete="identificacion" autofocus
                                placeholder="Ingrese su identificación">

                            @error('identificacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Pregunta 1 --}}
                        {{-- <div class="col-lg-6 col-md-12 mb-4">
                            <label for="tiene_reporte" class="form-label">¿Cuenta con su reporte de crédito?</label>
                            <select name="tiene_reporte" class="form-select form-control" id="tiene_reporte" required>
                                @foreach ($si_no_nose as $respuesta)
                                    <option value="{{ $respuesta }}"
                                        @if ($respuesta == old('tiene_reporte')) selected @endif>
                                        {{ $respuesta }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tiene_reporte')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        {{-- Pregunta 2 --}}
                        {{-- <div class="col-lg-6 col-md-12 mb-4">
                            <label for="conoce_puntaje" class="form-label">¿Conoce qué puntaje (score) tiene
                                actualmente?</label>
                            <select name="conoce_puntaje" class="form-select form-control" id="conoce_puntaje" required>
                                @foreach ($si_no_nose as $respuesta)
                                    <option value="{{ $respuesta }}"
                                        @if ($respuesta == old('conoce_puntaje')) selected @endif>
                                        {{ $respuesta }}
                                    </option>
                                @endforeach
                            </select>
                            @error('conoce_puntaje')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        {{-- Pregunta 3 --}}
                       {{--  <div class="col-lg-6 col-md-12 mb-4">
                            <label for="tiene_deudas" class="form-label">¿Tiene deudas vencidas?</label>
                            <select name="tiene_deudas" class="form-select form-control" id="tiene_deudas" required>
                                @foreach ($si_no_nose as $respuesta)
                                    <option value="{{ $respuesta }}"
                                        @if ($respuesta == old('tiene_deudas')) selected @endif>
                                        {{ $respuesta }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tiene_deudas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        {{-- Pregunta 4 --}}
                        {{-- <div class="col-lg-6 col-md-12 mb-4">
                            <label for="es_cliente" class="form-label">¿Es cliente actual de Buró de Crédito
                                Ecuador?</label>
                            <select name="es_cliente" class="form-select form-control" id="es_cliente" required>
                                @foreach ($si_no as $respuesta)
                                    <option value="{{ $respuesta }}"
                                        @if ($respuesta == old('es_cliente')) selected @endif>
                                        {{ $respuesta }}
                                    </option>
                                @endforeach
                            </select>
                            @error('es_cliente')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-primary fw-bold btn-block w-100 rounded-pill">
                                {{ __('Continuar') }}
                            </button>
                        </div>

                        <small class="d-block py-2 text-secondary text-center">@ Copyright 2023 <b>Buró de Crédito Ecuador</b></small>
                    </div>
                </form>
                {{-- <button id="finalizarPedido" class="btn btn-secondary text-white d-block w-100 disabled"
                    onclick="finalizarPedido()">
                    <div id="spinnerFinalizarPedido" class="spinner-border spinner-border-sm me-2 d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    Finalizar pedido
                </button> --}}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .metodos-pago.active {
            background-color: #f8f8f8;
            border: 1px dashed #ddd;
            position: relative;
            left: -8px;
            padding: 8px;
            font-weight: bold;
            border-radius: 4px;
        }

        .text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
@endsection

@section('js')
    <script>
        // const formatearNumero = window.utils.formatearNumero;
        let metodoPagoSeleccionado = document.getElementById("metodoPagoSeleccionado");
        const finalizarPedidoButton = document.getElementById("finalizarPedido");
        const metodosPago = document.getElementsByClassName("metodos-pago");
        const direccion_envio = document.getElementById("direccion_envio");
        const comentario = document.getElementById("comentario");
        const spinnerFinalizarPedido = document.getElementById("spinnerFinalizarPedido");
        let metodoPago = null;

        const finalizarPedido = async () => {
            let url = "";
            const data = {
                metodo_pago: metodoPagoSeleccionado.value,
                comentario: comentario.value,
            }

            spinnerFinalizarPedido.classList.remove("d-none");

            try {
                const response = await axios.post(url, data);
                let url_detalles = "";
                url_detalles = url_detalles.replace(':pedido', response.data.id_pedido);

                window.location.href = url_detalles;
            } catch (error) {
                // notificaciones.notificarError(error.response.data.mensaje);
                spinnerFinalizarPedido.classList.add("d-none");
            }
        }

        for (let i = 0; i < metodosPago.length; i++) {
            metodosPago[i].addEventListener("click", function(e) {
                if (metodoPago) {
                    document.getElementById(metodoPago).classList.remove("active");
                }
                this.classList.add("active");
                metodoPagoSeleccionado.value = this.getAttribute("data-metodo-pago");
                metodoPago = this.getAttribute("id");
                finalizarPedidoButton.classList.remove("disabled");
            });
        }
    </script>

    {{-- Boton whatsapp --}}
    <script>
        const botonWhatsapp = document.getElementById("boton-whatsapp")

        if (botonWhatsapp) {
            const link = document.createElement("a")
            const celular = "0" + document.getElementsByName("whatsapp")[0].value
            const phone = "593" + celular.substring(1, celular.length)

            if (window.innerWidth < 768) {
                link.href = `https://api.whatsapp.com/send?phone=${phone}`
            } else {
                link.href = `https://web.whatsapp.com/send?phone=${phone}`
            }

            link.target = "_blank"
            link.classList.add("btn", "btn-success", "text-white", "w-100", "mb-4")

            // icono
            const i = document.createElement("i")
            i.classList.add("bi-whatsapp", "me-2")

            const texto = document.createElement('span')
            texto.innerHTML = '¿Necesitas ayuda?'

            link.appendChild(i)
            link.appendChild(texto)

            botonWhatsapp.appendChild(link)
        }
    </script>

    <script>
        async function filtrarCiudades($event) {
            const selectorCiudades = document.getElementById('selector_ciudades')

            const response = await axios.get(`ciudades/${$event.target.value}`)
            const data = response.data

            selectorCiudades.innerHTML = ''
            data.forEach(element => {
                const option = document.createElement('option')
                option.setAttribute('value', element.id)
                option.innerHTML = element.nombre
                selectorCiudades.appendChild(option)
            })
        }

        const selectorProvincias = document.getElementById('selector_provincias')
        selectorProvincias.addEventListener('change', (event) => filtrarCiudades(event))

        // window.onload = filtrarCiudades(7)
    </script>
@endsection
