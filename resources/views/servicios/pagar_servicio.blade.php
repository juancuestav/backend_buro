@extends('layouts.full_app')

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <!-- Card principal -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- Header del card -->
                    <div class="card-header bg-gradient text-white py-4 border-0"
                        style="background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);">
                        <div class="text-center">
                            <i class="bi bi-credit-card-2-front fs-2 mb-2"></i>
                            <h3 class="mb-0 fw-bold">{{ __('Confirmar Compra') }}</h3>
                            <p class="mb-0 opacity-90">Complete su transacción de forma segura</p>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <!-- Mensaje informativo -->
                        <div class="alert alert-info border-0 rounded-3 mb-4" style="background-color: #e3f2fd;">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-info-circle-fill text-info me-3 mt-1"></i>
                                <div>
                                    <p class="mb-2 fw-semibold">{{ __('Instrucciones de pago') }}</p>
                                    <p class="mb-1 small">
                                        {{ __('Confirme su compra realizando el pago. Presione el botón para proceder con su compra.') }}
                                    </p>
                                    <p class="mb-0 small">{{ __('No olvide tomar una foto de su pago.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Métodos de pago -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-dark">
                                <i class="bi bi-wallet2 me-2"></i>Métodos de pago
                            </h5>

                            <!-- Opción tarjetas -->
                            <div class="payment-option mb-3">
                                <div class="form-check p-3 rounded-3 border border-2 payment-card"
                                    style="cursor: pointer; transition: all 0.3s ease;">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="credit"
                                        value="credit" checked>
                                    <label class="form-check-label w-100" for="credit" style="cursor: pointer;">
                                        <div class="d-flex align-items-center">
                                            <div class="payment-icon me-3">
                                                <i class="bi bi-credit-card text-primary fs-4"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Pagar con tarjeta</div>
                                                <small class="text-muted">Crédito o débito</small>
                                            </div>
                                            <div class="ms-auto">
                                                <i class="bi bi-chevron-right text-muted"></i>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Opción transferencia -->
                            <div class="payment-option mb-3">
                                <div class="form-check p-3 rounded-3 border border-2 payment-card"
                                    style="cursor: pointer; transition: all 0.3s ease;">
                                    <input class="form-check-input" type="radio" name="metodo_pago" id="transfer"
                                        value="transfer">
                                    <label class="form-check-label w-100" for="transfer" style="cursor: pointer;">
                                        <div class="d-flex align-items-center">
                                            <div class="payment-icon me-3">
                                                <i class="bi bi-bank text-success fs-4"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Transferencia bancaria</div>
                                                <small class="text-muted">Desde tu banco</small>
                                            </div>
                                            <div class="ms-auto">
                                                <i class="bi bi-chevron-right text-muted"></i>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de pago con tarjeta -->
                        <div id="credit_options" class="credit-options mb-4">
                            <div class="card bg-light border-0 rounded-3">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-3 text-center">
                                        <i class="bi bi-credit-card-2-back me-2"></i>Selecciona tu tipo de tarjeta
                                    </h6>

                                    <div class="row g-3">
                                        <!-- Tarjetas nacionales -->
                                        <div class="col-md-6">
                                            <button id="btn_national_cards"
                                                class="btn btn-outline-primary w-100 h-100 rounded-3 p-3 card-type-btn">
                                                <div class="text-center">
                                                    <i class="bi bi-geo-alt-fill fs-3 mb-2 d-block"></i>
                                                    <div class="fw-semibold mb-1">Tarjetas Nacionales</div>
                                                    <small class="text-muted">Emitidas en Ecuador</small>
                                                    <div class="mt-2">
                                                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='20' viewBox='0 0 30 20'%3E%3Crect width='30' height='20' fill='%23FFD700'/%3E%3Crect width='30' height='6.67' y='6.67' fill='%230052CC'/%3E%3Crect width='30' height='6.67' y='13.33' fill='%23DC143C'/%3E%3C/svg%3E"
                                                            alt="Ecuador" class="me-1" style="width: 20px;">
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <!-- Tarjetas internacionales -->
                                        <div class="col-md-6">
                                            <button id="btn_international_cards"
                                                class="btn btn-outline-success w-100 h-100 rounded-3 p-3 card-type-btn">
                                                <div class="text-center">
                                                    <i class="bi bi-globe-americas fs-3 mb-2 d-block"></i>
                                                    <div class="fw-semibold mb-1">Tarjetas Internacionales</div>
                                                    <small class="text-muted">Emitidas en el extranjero</small>
                                                    <div class="mt-2">
                                                        <i class="bi bi-credit-card text-success"></i>
                                                        <i class="bi bi-credit-card-2-front text-primary ms-1"></i>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botón PayPal (oculto por defecto) -->
                        <div id="paypal_option" class="d-none mb-4">
                            <a id="btn_paypal" href="{{ $servicio->url_paypal }}"
                                class="btn btn-warning w-100 rounded-3 p-3 fw-semibold" target="_blank">
                                <i class="bi bi-paypal me-2 fs-5"></i>
                                {{ __('Pagar con PayPal') }}
                            </a>
                        </div>

                        <!-- Información de transferencia -->
                        <div id="transfer_info" class="transfer-info d-none">
                            <div class="card border-0 rounded-3"
                                style="background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%);">
                                <div class="card-body p-4 text-center">
                                    <h6 class="fw-bold mb-3">
                                        <i class="bi bi-bank2 me-2"></i>Datos para la transferencia
                                    </h6>

                                    <!-- Contenedor de imagen con zoom -->
                                    <div class="position-relative d-inline-block">
                                        <img id="transfer_image" src="{{ asset('img/pagos_transferencias.jpeg') }}"
                                            alt="Datos de transferencia"
                                            class="img-fluid rounded-3 shadow-sm transfer-image"
                                            style="max-width: 80%; cursor: pointer;">

                                        <!-- Indicador de zoom -->
                                        <div class="zoom-indicator">
                                            <i class="bi bi-zoom-in"></i>
                                            <span class="zoom-text">Toca para ampliar</span>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="bi bi-shield-check me-1"></i>
                                            Información bancaria verificada y segura
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de imagen en pantalla completa -->
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header border-0 position-absolute w-100" style="z-index: 1050;">
                                        <h5 class="modal-title text-white" id="imageModalLabel">
                                            <i class="bi bi-bank2 me-2"></i>Datos para transferencia bancaria
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body d-flex align-items-center justify-content-center p-0">
                                        <div class="image-container">
                                            <img id="modal_image" src="{{ asset('img/pagos_transferencias.jpeg') }}"
                                                alt="Datos de transferencia" class="modal-image">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 position-absolute w-100 bottom-0"
                                        style="z-index: 1050;">
                                        <div class="d-flex justify-content-center w-100">
                                            <button type="button" class="btn btn-light rounded-pill me-2"
                                                id="zoom_in">
                                                <i class="bi bi-zoom-in"></i> Acercar
                                            </button>
                                            <button type="button" class="btn btn-light rounded-pill me-2"
                                                id="zoom_out">
                                                <i class="bi bi-zoom-out"></i> Alejar
                                            </button>
                                            <button type="button" class="btn btn-light rounded-pill" id="reset_zoom">
                                                <i class="bi bi-arrow-clockwise"></i> Restablecer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer del card -->
                    <div class="card-footer bg-light border-0 py-4">
                        <div class="text-center">
                            <a href="{{ route('public.servicios.index') }}"
                                class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i>
                                Cancelar y ver servicios
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Información de seguridad -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <i class="bi bi-shield-lock me-1"></i>
                        Transacción segura protegida con encriptación SSL
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Elementos del DOM
        const creditOptions = document.getElementById('credit_options')
        const transferInfo = document.getElementById('transfer_info')
        const paypalOption = document.getElementById('paypal_option')
        const btnNationalCards = document.getElementById('btn_national_cards')
        const btnInternationalCards = document.getElementById('btn_international_cards')

        // Radio buttons
        const radios = document.getElementsByName("metodo_pago");

        // Event listeners para radio buttons
        for (var i = 0, max = radios.length; i < max; i++) {
            radios[i].onclick = function() {
                // Remover clase activa de todas las tarjetas
                document.querySelectorAll('.payment-card').forEach(card => {
                    card.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10')
                })

                // Agregar clase activa a la tarjeta seleccionada
                this.closest('.payment-card').classList.add('border-primary', 'bg-primary', 'bg-opacity-10')

                switch (this.value) {
                    case 'credit':
                        creditOptions.classList.remove('d-none')
                        transferInfo.classList.add('d-none')
                        paypalOption.classList.add('d-none')
                        break
                    case 'transfer':
                        transferInfo.classList.remove('d-none')
                        creditOptions.classList.add('d-none')
                        paypalOption.classList.add('d-none')
                        break
                    case 'paypal':
                        paypalOption.classList.remove('d-none')
                        creditOptions.classList.add('d-none')
                        transferInfo.classList.add('d-none')
                        break
                }
            }
        }

        // Función para procesar pago
        async function procesarPago(tipoTarjeta) {
            try {
                // Mostrar loading
                const btn = tipoTarjeta === 'nacional' ? btnNationalCards : btnInternationalCards
                const originalText = btn.innerHTML
               /*  btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Procesando...'
                btn.disabled = true */

                const identificacion = @json(session('identificacion'));
                const servicio = @json($servicio);

                console.log('Identificación desde sesión:', identificacion);
                console.log('Tipo de tarjeta:', tipoTarjeta);

                // Incrementar contador
                await window.axios.get(window.location.origin + '/pagar-payphone')

                // Realizar pago con parámetro adicional para tipo de tarjeta
                const response = await window.axios.post(window.location.origin + '/api/public/payphone/pagar', {
                    identificacion: identificacion,
                    servicio_id: servicio.id,
                    tipo_tarjeta: tipoTarjeta // Nuevo parámetro
                })

                console.log('URL de redirección:', response.data.redirect_url)
                window.location.href = response.data.redirect_url

            } catch (error) {
                console.error('Error al procesar pago:', error)
                // Restaurar botón
                btn.innerHTML = originalText
                btn.disabled = false

                // Mostrar error
                alert('Error al procesar el pago. Por favor intente nuevamente.')
            }
        }

        // Event listeners para botones de tarjetas
        btnNationalCards.addEventListener('click', () => procesarPago('nacional'))
        btnInternationalCards.addEventListener('click', () => procesarPago('internacional'))

        // Funcionalidad de zoom para imagen de transferencia
        const transferImage = document.getElementById('transfer_image')
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'))
        const modalImage = document.getElementById('modal_image')
        const zoomInBtn = document.getElementById('zoom_in')
        const zoomOutBtn = document.getElementById('zoom_out')
        const resetZoomBtn = document.getElementById('reset_zoom')

        let currentZoom = 1
        let isDragging = false
        let startX, startY, scrollLeft, scrollTop

        // Abrir modal al hacer clic en la imagen
        transferImage.addEventListener('click', function() {
            imageModal.show()
            currentZoom = 1
            updateImageZoom()
        })

        // Funciones de zoom
        function updateImageZoom() {
            modalImage.style.transform = `scale(${currentZoom})`
            modalImage.style.cursor = currentZoom > 1 ? 'grab' : 'default'
        }

        zoomInBtn.addEventListener('click', function() {
            currentZoom = Math.min(currentZoom + 0.5, 4)
            updateImageZoom()
        })

        zoomOutBtn.addEventListener('click', function() {
            currentZoom = Math.max(currentZoom - 0.5, 0.5)
            updateImageZoom()
        })

        resetZoomBtn.addEventListener('click', function() {
            currentZoom = 1
            updateImageZoom()
            modalImage.style.transformOrigin = 'center center'
        })

        // Arrastrar imagen cuando está con zoom
        modalImage.addEventListener('mousedown', function(e) {
            if (currentZoom > 1) {
                isDragging = true
                modalImage.style.cursor = 'grabbing'
                startX = e.pageX - modalImage.offsetLeft
                startY = e.pageY - modalImage.offsetTop
            }
        })

        document.addEventListener('mousemove', function(e) {
            if (!isDragging || currentZoom <= 1) return
            e.preventDefault()
            const x = e.pageX - startX
            const y = e.pageY - startY
            modalImage.style.transformOrigin = `${x}px ${y}px`
        })

        document.addEventListener('mouseup', function() {
            isDragging = false
            modalImage.style.cursor = currentZoom > 1 ? 'grab' : 'default'
        })

        // Soporte táctil para dispositivos móviles
        let initialDistance = 0
        let initialZoom = 1

        modalImage.addEventListener('touchstart', function(e) {
            if (e.touches.length === 2) {
                e.preventDefault()
                initialDistance = Math.hypot(
                    e.touches[0].pageX - e.touches[1].pageX,
                    e.touches[0].pageY - e.touches[1].pageY
                )
                initialZoom = currentZoom
            } else if (e.touches.length === 1 && currentZoom > 1) {
                isDragging = true
                startX = e.touches[0].pageX - modalImage.offsetLeft
                startY = e.touches[0].pageY - modalImage.offsetTop
            }
        })

        modalImage.addEventListener('touchmove', function(e) {
            if (e.touches.length === 2) {
                e.preventDefault()
                const distance = Math.hypot(
                    e.touches[0].pageX - e.touches[1].pageX,
                    e.touches[0].pageY - e.touches[1].pageY
                )
                currentZoom = Math.max(0.5, Math.min(4, initialZoom * (distance / initialDistance)))
                updateImageZoom()
            } else if (e.touches.length === 1 && isDragging && currentZoom > 1) {
                e.preventDefault()
                const x = e.touches[0].pageX - startX
                const y = e.touches[0].pageY - startY
                modalImage.style.transformOrigin = `${x}px ${y}px`
            }
        })

        modalImage.addEventListener('touchend', function(e) {
            if (e.touches.length === 0) {
                isDragging = false
            }
        })

        // Double tap para zoom en móviles
        let lastTouchEnd = 0
        modalImage.addEventListener('touchend', function(e) {
            const now = new Date().getTime()
            if (now - lastTouchEnd <= 300) {
                e.preventDefault()
                if (currentZoom === 1) {
                    currentZoom = 2
                } else {
                    currentZoom = 1
                }
                updateImageZoom()
            }
            lastTouchEnd = now
        })

        // Inicializar estado
        document.getElementById('credit').click()
    </script>
@endsection

@section('css')
    <style>
        .payment-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .payment-card:hover {
            border-color: #0d6efd !important;
            background-color: rgba(13, 110, 253, 0.05) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.1);
        }

        .payment-icon {
            width: 50px;
            height: 50px;
            background: rgba(13, 110, 253, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-type-btn {
            transition: all 0.3s ease;
            min-height: 120px;
        }

        .card-type-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-type-btn:active {
            transform: translateY(-1px);
        }

        .transfer-info {
            animation: slideIn 0.3s ease-in-out;
        }

        .credit-options {
            animation: slideIn 0.3s ease-in-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .bg-gradient {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
        }

        /* Estilos para imagen de transferencia con zoom */
        .transfer-image {
            transition: all 0.3s ease;
            position: relative;
        }

        .transfer-image:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .zoom-indicator {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .transfer-image:hover+.zoom-indicator,
        .transfer-image:hover~.zoom-indicator {
            opacity: 1;
        }

        /* Posicionar correctamente el indicador */
        .transfer-image:hover+.zoom-indicator {
            opacity: 1;
        }

        .transfer-image:hover::after {
            content: '';
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            z-index: 10;
        }

        /* Estilos del modal de imagen */
        .modal-image {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            transition: transform 0.3s ease;
            transform-origin: center center;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
        }

        .image-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .modal-header,
        .modal-footer {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
        }

        .modal-footer {
            justify-content: center;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-type-btn {
                min-height: 100px;
            }

            .payment-icon {
                width: 40px;
                height: 40px;
            }

            .zoom-text {
                display: none;
            }

            .modal-header h5 {
                font-size: 1rem;
            }

            .modal-footer .btn {
                padding: 8px 16px;
                font-size: 14px;
            }

            .modal-image {
                max-width: 95%;
                max-height: 85%;
            }
        }

        /* Loading state */
        .btn:disabled {
            opacity: 0.7;
        }

        /* Animación del indicador de zoom */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .zoom-indicator i {
            animation: pulse 2s infinite;
        }
    </style>
@endsection
