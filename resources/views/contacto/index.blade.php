@extends('layouts.app')

@section('content')
    <div class="container mt-4" style="margin-bottom: calc(100vh - 698px)">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <form action="{{ route('notificaciones-contacto.store') }}" method="POST">
                @csrf

                <div class="row px-4">
                    <div class="col-md-4 mt-5 text-center">
                        <h2 class="fw-bold mb-4">Contáctanos</h2>
                        <lottie-player src="/img/lottie/contact2.json" class="mx-auto"
                            background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay>
                        </lottie-player>
                        {{-- <img height="300" src="{{ asset('img/movil.png') }}" alt=""> --}}
                    </div>
                    <div class="col-md-8">
                        <div class="row my-4">
                            {{-- Nombre --}}
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    name="nombre" id="nombre" placeholder="Obligatorio" value="{{ old('nombre') }}"
                                    required>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Apellidos --}}
                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="name" class="form-label">Apellidos</label>
                                <input type="text" class="form-control @error('apellidos') is-invalid @enderror"
                                    name="apellidos" id="apellidos" placeholder="Obligatorio"
                                    value="{{ old('apellidos') }}" required>
                                @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                    name="correo" id="correo" placeholder="Obligatorio" value="{{ old('correo') }}"
                                    required>
                                @error('correo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-md-12 mt-4">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="text" class="form-control @error('celular') is-invalid @enderror"
                                    name="celular" id="celular" placeholder="Obligatorio" value="{{ old('celular') }}"
                                    required>
                                @error('celular')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <label for="message" class="form-label">Mensaje</label>
                                <textarea rows="3" class="form-control @error('mensaje') is-invalid @enderror" name="mensaje" id="mensaje"
                                    placeholder="Obligatorio" required>{{ old('mensaje') }}</textarea>
                                @error('mensaje')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid mt-4 d-md-flex justify-content-md-end">
                                <button id="btnSendEmail" type="submit" class="btn btn-primary text-morado rounded-pill px-3 fw-bold"><i class="bi-send me-2"></i>Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
