@extends('layouts.full_app')

@section('content')
    <div class="row g-0">
        <div class="col-md-6 bg-white">
            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-center py-5">
                <img src="{{ asset('img/logo.webp') }}" alt="logo empresa" width="30" class="me-2"><span
                    class="fs-2">{{ __('Buró de crédito Ecuador') }}</span>
            </div>

            {{-- Body --}}
            <div class="d-flex flex-column col-md-6 col-10 text-center mx-auto py-5">
                <div class="fw-bold text-center fs-4 mb-4">{{ __('Recuperar contraseña') }}</div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success text-white btn-block w-100">
                                {{ __('Enviar enlace de recuperación') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="imagen d-flex align-items-center justify-content-center">
                <lottie-player src="/img/lottie/password.json" background="transparent" speed="1"
                    style="width: 740px; height: 740px;" loop autoplay></lottie-player>
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
