@extends('layouts.full_app')

@section('content')
    <div class="row g-0">
        <div class="col-md-6 bg-white">
            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-center py-5 mb-5 w-100">
                <img src="{{ asset('img/logo.webp') }}" alt="logo empresa" width="30" class="me-2"><span
                    class="fs-2">{{ __('Buró de crédito Ecuador') }}</span>
            </div>

            {{-- Body --}}
            <div class="d-flex flex-column col-10 mx-auto py-5">
                <div class="fw-bold text-center fs-4 mb-4">{{ __('Registrate') }}</div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        {{-- Nombre --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>

                            <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="Ingrese su nombre">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Apellidos --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="name" class="form-label">{{ __('Apellidos') }}</label>

                            <input id="apellidos" type="text"
                                class="form-control @error('apellidos') is-invalid @enderror" name="apellidos"
                                value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus
                                placeholder="Ingrese sus apellidos">

                            @error('apellidos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Fecha de nacimiento --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="edad" class="form-label">{{ __('Edad') }}</label>

                            <input id="edad" type="number"
                                class="form-control @error('edad') is-invalid @enderror" name="edad"
                                value="{{ old('edad') }}" autocomplete="edad" autofocus
                                placeholder="Ingrese su edad">

                            @error('edad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Direccion --}}
                        <div class="col-lg-6 col-md-12 mb-4">
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
                        </div>

                        {{-- Celular --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="celular" class="form-label">{{ __('Celular') }}</label>

                            <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror"
                                name="celular" value="{{ old('celular') }}" required autocomplete="celular" autofocus
                                placeholder="Ingrese su número celular">

                            @error('celular')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Correo --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="email" class="form-label">{{ __('Correo') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Ingrese su correo electrónico">

                            @error('email')
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

                        {{-- Contraseña --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Ingrese su contraseña">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Confirmar contraseña --}}
                        <div class="col-lg-6 col-md-12 mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar contraseña') }}</label>

                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirme su contraseña">
                        </div>

                        <div class="col-12">
                            <div class="">
                                <button type="submit" class="btn btn-success text-white btn-block w-100">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>

                        <small class="d-block py-5 text-secondary text-center">@ Copyright 2022 DigitalSpace</small>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="imagen d-flex align-items-center justify-content-center">
                <lottie-player src="/img/lottie/login.json" background="transparent" speed="1"
                    style="width: 400px; height: 400px;" loop autoplay></lottie-player>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .imagen {
            height: 100vh;
            width: 100%;
        }

        .formulario {
            z-index: 10;
        }
    </style>
@endsection
