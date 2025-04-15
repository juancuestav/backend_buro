@extends('layouts.full_app')

@section('content')
    <div class="row g-0">
        {{-- Formulario --}}
        <div class="col-md-6 bg-white">
            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-center py-5 mb-5">
                <img src="{{ asset('img/logo.webp') }}" alt="logo empresa" width="30" class="me-2"><span
                    class="fs-2">{{ __('Buró de crédito Ecuador') }}</span>
            </div>

            {{-- Body --}}
            <div class="d-flex flex-column col-md-6 col-10 text-center mx-auto py-5">
                <div class="fw-bold text-center fs-4 mb-4">{{ __('Inicio de sesión') }}</div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="mb-2">{{ __('Correo electrónico') }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Ingrese su correo">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="mb-2">{{ __('Contraseña') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Ingrese su contraseña">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recuérdame') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-success text-white w-100">
                                {{ __('Iniciar sesión') }}
                            </button>
                        </div>

                        <div class="col-12 mb-3">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div>

                        <div class="col-12 mb-2">
                            <a href="{{ route('register') }}" class="btn btn-light w-100">
                                {{ __('Crear cuenta') }}
                            </a>
                        </div>
                    </div>

                    <small class="d-block py-5 text-secondary">@ Copyright 2022 DigitalSpace</small>
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
