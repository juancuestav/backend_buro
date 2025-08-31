@extends('layouts.full_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 py-4">
                <div class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/buro.png') }}" alt="logo empresa" width="80" class="mb-3">
                    <div class="mb-4"><b>
                            Buró de crédito Ecuador</b>
                    </div>
                </div>

                <div class="card border gradiente-blanco mb-4">
                    <div class="card-header fw-bold">{{ __('Confirmar compra') }}</div>

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

                        <button id="btn_credit" class="btn bg-primary-app text-white d-block mx-auto   mb-2">
                            <i class="bi-credit-card me-2"></i>
                            {{ __('Pagar con tarjeta de crédito o débito') }}</button>

                        <a id="btn_paypal" href="{{ $servicio->url_paypal }}"
                            class="btn btn-success text-white d-block d-none" target="_blank">
                            <i class="bi-paypal me-2"></i>
                            {{ __('Pagar con Paypal') }}</a>

                        <div id="btn_transfer" class="datos_transfer text-center d-none">
                            <div class="fw-bold mb-2">
                                Datos para la transferencia
                            </div>

                            <img src="{{ asset('img/pagos_transferencias.jpeg') }}" alt="logo empresa" width="60%"
                                class="mb-3">
                            {{-- <div>Cuenta: <b>{{ $configuracion_general['numero_cuenta'] }}</b></div>
                            <div>Entidad financiera: <b>{{ $configuracion_general['entidad_financiera'] }}</b></div>
                            <div>Propietario de la cuenta: <b>{{ $configuracion_general['propietario_cuenta'] }}</b></div>
                            <div>Identificación del propietario de la cuenta:
                                <b>{{ $configuracion_general['identificacion_propietario_cuenta'] }}</b>
                            </div>
                            <small>Por favor, realice la transferencia o depósito y luego póngase en contacto con nosotros
                                mediante
                                el/los número(s) {{ $configuracion_general['numero_contacto'] }}</small> --}}
                        </div>
                    </div>
                </div>

                <div class="text-center">

                    <a href="{{ route('public.servicios.index') }}" class="btn btn-primary text-center">
                        Cancelar compra y seguir viendo el listado de servicios que ofrecemos</a>
                </div>
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

        btn_credit.addEventListener('click', async () => {
            const identificacion = @json(session('identificacion'));
            const servicio = @json($servicio);

            console.log('Identificación desde sesión:', identificacion);

            window.axios.get(window.location.origin +
                '/pagar-payphone') // aumenta en +1 el contador de compras por payphone
            const response = await window.axios.post(window.location.origin + '/api/public/payphone/pagar', {
                identificacion: identificacion,
                servicio_id: servicio.id,
            }) // verificar si cuenta existe
            console.log(response.data.redirect_url)
            window.location.href = response.data.redirect_url
            // window.location.replace('{{ $servicio->url_destino }}')
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
