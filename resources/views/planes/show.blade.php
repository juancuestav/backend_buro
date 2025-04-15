@extends('layouts.app')

@section('content')
    <div class="cabecera"></div>

    <div class="container pt-4">
        <div class="mb-4">
            <a href="{{ route('planes.index') }}" class="btn btn-primary btn-sm border border-1 rounded-3 me-2"><i
                    class="bi-chevron-left"></i></a><span class="text-white text-shadow">Regresar</span>
        </div>
        <div class="p-4 mb-5">
            @if ($plan->estado == 'BORRADOR')
                <p class="text-white">Este plan no está disponible por el momento.</p>
            @else
                <div class="row mb-4">
                    <div class="col-12 text-center py-4 text-white fs-2 text-shadow">Adquiérelo Ya!</div>

                    {{-- Carrito --}}
                    <div class="col-12 text-center">
                        @auth
                            <button class="btn btn-primary mb-2 me-2" onclick="agregarCarrito()"><i
                                    class="bi-cart me-2"></i>Agregar
                                al carrito</button>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary mb-2"><i class="bi-cart me-2"></i>Agregar
                                al carrito</a>
                        @endguest
                        <button class="btn btn-light mb-2" onclick="comprarAhora()"><i class="bi-wallet me-2"></i>Comprar
                            ahora</button>
                    </div>

                    {{-- Imagen --}}
                    <div class="col-md-4 mx-auto imagen p-0">
                        <img id="imagenServicio" class="w-100" style="object-fit: cover"
                            src="{{ $plan->images?->url ?? url('img/logo.webp') }}" alt="Imagen plan">
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="row pt-5">
                                {{-- Detalles --}}
                                <div class="col-12 mb-2">
                                    <h1 class="fs-4 fw-bold mb-4">{{ strtoupper($plan->nombre) }}</h1>
                                    <small id="incluyeIva" class="mb-2">IVA inluido</small>
                                    <p class="d-flex align-items-start"><span class="mt-1">{{ __('Precio:') }}
                                        </span>
                                        <span id="precio-producto" class="fs-3 ms-2">
                                            {{ $plan->precio_unitario + $plan->iva }}
                                        </span>
                                    </p>
                                    <p>{!! $plan->descripcion !!}</p>
                                </div>

                                {{-- Carrito --}}
                                <div class="col-12">
                                    @auth
                                        <button class="btn btn-primary mb-2" onclick="agregarCarrito()"><i
                                                class="bi-cart me-2"></i>Agregar al
                                            carrito</button>
                                    @endauth

                                    @guest
                                        <a href="{{ route('login') }}" class="btn btn-primary mb-2"><i
                                                class="bi-cart me-2"></i>Agregar al carrito</a>
                                    @endguest
                                    <button class="btn btn-light mb-2" onclick="comprarAhora()"><i
                                            class="bi-wallet me-2"></i>Comprar
                                        ahora</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <input type="hidden" name="plan" value="{{ $plan->id }}">
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        async function agregarCarrito() {
            let plan = document.querySelector("input[name=plan]").value;

            const data = {
                servicio: parseInt(plan),
            };

            try {
                const response = await axios.post("{{ route('carrito.agregar') }}", data);
                notificaciones.notificarCorrecto(response.data.mensaje)
            } catch (error) {
                notificaciones.notificarError(error.response.data.message)
            }
        }

        async function comprarAhora() {
            await agregarCarrito();
            window.location.href = "{{ route('carrito') }}";
        }

        window.agregarCarrito
        window.comprarAhora
    </script>
@endsection

@section('css')
    <style>
        .cabecera {
            background-image: linear-gradient(to bottom, rgba(39, 48, 226, 0.6) 4%, rgba(0, 0, 0, 1) 70%), url("../img/textura.png");
            background-repeat: no-repeat;
            background-position: bottom;
            background-attachment: fixed;
            background-size: cover;
            object-position: center;
            clip-path: polygon(100% 0, 100% 74%, 50% 100%, 0 74%, 0 0);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 400px;
            z-index: -1;
        }

        .imagen {
            margin-top: 20px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 16px;
            overflow: hidden;
            background-color: #fff;
        }
    </style>
@endsection
