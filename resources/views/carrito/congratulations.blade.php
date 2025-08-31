@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 mb-5">

                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <h1 class="card-title text-success mb-4">¡Gracias por tu compra!</h1>
                        <p class="card-text fs-5">Tu compra se ha realizado con éxito. Esperamos que disfrutes de tu
                            servicio.</p>

                        <div class="my-4">
                            <a href="{{ env('SPA_URL') }}" class="btn bg-primary-app text-white" target="_blank">
                                Ir a la aplicación
                            </a>
                        </div>

                        <p class="text-muted small">Si tienes alguna duda, no dudes en contactarnos.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
