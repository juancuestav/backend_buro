@extends('layouts.full_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 py-4">
                <div class="text-center">
                    <img src="{{ asset('img/logo.webp') }}" alt="logo empresa" width="44" class="mb-3">
                    <div class="mb-4"><b>
                            Buró de
                            crédito Ecuador</b>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>

                <a href="{{ route('inicio') }}" class="d-block text-center">Volver a la página de inicio</a>
            </div>
        </div>
    </div>
@endsection
