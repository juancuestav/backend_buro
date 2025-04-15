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
                    <div class="card-header">{{ __('Confirmar compra') }}</div>

                    <div class="card-body">
                        <p>
                            {{ __('Confirme su compra realizando el pago. Presione el botón para proceder con su compra.') }}
                            {{ __('No olvide tomar una foto de su pago.') }}
                        </p>

                        <div class="fw-bold mb-2">Métodos de pago</div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="credit" value="credit"
                                checked>
                            <label class="form-check-label" for="credit">
                                Pagar con tarjeta de crédito o débito
                            </label>
                        </div>

                        {{-- <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="paypal" value="paypal">
                            <label class="form-check-label" for="paypal">
                                Pagar con Paypal
                            </label>
                        </div> --}}

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="transfer"
                                value="transfer">
                            <label class="form-check-label" for="transfer">
                                Pagar mediante transferencia
                            </label>
                        </div>

                        {{-- ////////////// --}}
                        {{-- <a id="btn_credit" href="{{ $servicio->url_destino }}"
                            class="btn btn-success text-white d-block mb-2" target="_blank">
                            <i class="bi-credit-card me-2"></i>
                            {{ __('Pagar con tarjeta de crédito') }}</a> --}}

                        <button id="btn_credit" class="btn btn-success text-white d-block mx-auto   mb-2">
                            <i class="bi-credit-card me-2"></i>
                            {{ __('Pagar con tarjeta de crédito') }}</button>

                        <a id="btn_paypal" href="{{ $servicio->url_paypal }}"
                            class="btn btn-success text-white d-block d-none" target="_blank">
                            <i class="bi-paypal me-2"></i>
                            {{ __('Pagar con Paypal') }}</a>

                        <div id="btn_transfer" class="datos_transfer d-none">
                            <div class="fw-bold mb-2">
                                Datos para la transferencia
                            </div>
                            <div>Cuenta: <b>{{ $configuracion_general['numero_cuenta'] }}</b></div>
                            <div>Entidad financiera: <b>{{ $configuracion_general['entidad_financiera'] }}</b></div>
                            <div>Propietario de la cuenta: <b>{{ $configuracion_general['propietario_cuenta'] }}</b></div>
                            <div>Identificación del propietario de la cuenta:
                                <b>{{ $configuracion_general['identificacion_propietario_cuenta'] }}</b>
                            </div>
                            <small>Por favor, realice la transferencia o depósito y luego póngase en contacto con nosotros
                                mediante
                                el/los número(s) {{ $configuracion_general['numero_contacto'] }}</small>
                        </div>
                    </div>
                </div>

                <a href="{{ route('public.servicios.index') }}" class="d-block text-center">
                    Continuar viendo el listado de servicios</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const btn_credit = document.getElementById('btn_credit')
        const btn_transfer = document.getElementById('btn_transfer')
        const btn_paypal = document.getElementById('btn_paypal')

        var radios = document.getElementsByName("metodo_pago");
        for (var i = 0, max = radios.length; i < max; i++) {
            radios[i].onclick = function() {
                switch (this.value) {
                    case 'credit':
                        btn_credit.classList.remove('d-none')
                        btn_transfer.classList.add('d-none')
                        btn_paypal.classList.add('d-none')
                        break
                    case 'transfer':
                        btn_transfer.classList.remove('d-none')
                        btn_credit.classList.add('d-none')
                        btn_paypal.classList.add('d-none')
                        break
                    case 'paypal':
                        btn_paypal.classList.remove('d-none')
                        btn_credit.classList.add('d-none')
                        btn_transfer.classList.add('d-none')
                        break
                }
            }
        }

        btn_credit.addEventListener('click', () => {
            window.axios.get(window.location.origin + '/pagar-payphone')
            window.location.replace('{{ $servicio->url_destino }}')
        })
    </script>
@endsection

@section('css')
    <style>
        .datos_transfer {
            background-color: #fafafe;
            padding: 8px;
            border-radius: 4px;
            border: 1px dashed #eee;
        }
    </style>
@endsection
