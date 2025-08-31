@extends('layouts.app')

@section('content')
    <div class="container pt-4" style="margin-bottom: calc(100vh - 550px)">
        {{-- <div class="d-flex flex-column align-items-center header-servicios"></div> --}}

        {{-- <h1 class="fs-3 text-center p-4 mb-4">
            <i class="bi-person-workspace mb-3 fs-4 text-accent"></i> <br> <br>
            Nuestros servicios
        </h1> --}}

        <div class="text-center">
            <div class="seccion-categorias mx-auto">
                <a href="{{ route('public.servicios.index') }}" @class([
                    'seccion-categorias__item-categoria',
                    'categoria-activa' => is_null($categoria_seleccionada),
                ])>TODOS</a>
                @foreach ($categorias as $categoria)
                    <a @class([
                        'seccion-categorias__item-categoria',
                        'categoria-activa' => $categoria->id == $categoria_seleccionada,
                    ])
                        href="{{ route('public.servicios.index', ['categoria' => $categoria->id]) }}">{{ $categoria->nombre }}</a>
                @endforeach
            </div>
        </div>

        @if (count($servicios) > 0)
            <div class="row row-cols-md-3 row-cols-1 pt-4">
                @foreach ($servicios as $servicio)
                    <div class="col mb-5">
                        <div class="card rounded-card card-body h-100 gradiente-azul-morado text-white">
                            <div class="text-center">
                                <img width="100px" class="mb-4" src="{{ url($servicio->images->url ?? '') }}"
                                    alt="">
                            </div>
                            <h4 class="text-center py-3 fw-bold mb-4">{{ $servicio->nombre }}</h4>
                            <div class="p-3 text-color gradiente-blanco rounded-card text-black">{!! $servicio->descripcion !!}
                            </div>
                            <div class="fs-4 py-1 fst-italic text-center">
                                {{ '$' . priceFormat($servicio->precio_unitario + $servicio->iva) }}
                            </div>
                            @if ($servicio->gravable)
                                <div class="text-center">IVA incluido</div>
                            @else
                                <div class="text-center">Precio final (No incluye IVA)</div>
                            @endif
                            <a href="{{ route('public.servicios.show', $servicio) }}"
                                class="btn btn-primary fw-bold px-3 rounded-pill my-3 w-100">Adquirir servicio <i
                                    class="bi-chevron-right"></i></a>
                            <div class="text-center">
                                <i class="bi-bookmark-check-fill me-2 text-success"></i>TU COMPRA ES SEGURA
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="ps-3 pt-3">Aún no se han agregado servicios!</p>
        @endif


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

        .header-servicios>* {
            z-index: 50;
        }

        .header-servicios i {
            padding: 8px;
            /* color: #ffffff99; */
        }

        .header-servicios::before {
            position: absolute;
            content: "";
            /* background-color: #fff; */
            z-index: 10;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .seccion-categorias {
            background-color: #ffffff67;
            /* box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; */
            /* border-radius: 8px; */
            display: inline-block;
            margin: auto;
            /* margin-top: 96px; */
            backdrop-filter: blur(10px);
        }

        .seccion-categorias .seccion-categorias__item-categoria {
            padding: 8px 16px;
            text-decoration: none;
            display: inline-block;
            color: rgba(30, 58, 138, 1);
        }

        .seccion-categorias .seccion-categorias__item-categoria:hover {
            font-weight: bold;
            transition: all 0.15s ease;
        }

        .categoria-activa {
            background: linear-gradient(180deg,
                    rgba(75, 46, 131, 1) 0%,
                    rgba(30, 58, 138, 1) 100%);
            color: #eaecf9 !important;
            font-weight: bold;
            text-shadow: 1px 1px 1px #00000066;
            border-radius: 16px;
        }

        .categoria-activa:hover {
            color: #fff;
        }

        .conocer-mas {
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            /* right: 0; */
        }

        ul {
            list-style-image: url({{ asset('css/vineta.svg') }});
        }

        .desenfoque {
            backdrop-filter: blur(10PX);
            background-color: #ffffff3e;
        }
    </style>
@endsection
