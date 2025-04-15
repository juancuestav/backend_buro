@extends('layouts.app')

@section('content')
<h3 class="mb-5 text-center">Visitas</h3>
<div class="py-4 mb-4 contador">
    <div class="color_fondo" id="fondo_color"></div>
    <div class="numero" id="numero"></div>
</div>
@endsection

@section('js')
    {{-- Contador --}}
    <script>
        const color = document.getElementById('fondo_color')
        const numero = document.getElementById('numero')

        let cantidad = 0
        let tiempo = setInterval(() => {
            cantidad += 50

            if (cantidad <= 100) color.style.height = `${cantidad}%`
            numero.textContent = cantidad
            if (cantidad === 4000) {
                clearInterval(tiempo)
            }
        }, 100);
    </script>
@endsection

@section('css')
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
    </style>
@endsection
