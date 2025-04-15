<div class="container">
    <div class="row min-vh-10d">
        <!-- Left Section -->
        <div class="col-md-6 bg-custom-light d-flex align-items-center my-5 border-left text-morado">
            <div class="container row">
                <div class="col-12 col-md-6 app-screenshot mb-4">
                    <img src="{{ asset('img/inicio/celular.png') }}" alt="App Screenshot" class="img-flusid" height="400px">
                </div>
                <div class="col-12 col-md-6 text-center">
                    <h2 class="mb-4">AÚN MÁS FÁCIL:</h2>
                    <p class="mb-4">
                        Únete a las <strong class="text-purple">MILES DE PERSONAS</strong> que llevan sus finanzas en la
                        palma de su mano.
                    </p>

                    <img src="https://play.google.com/intl/en_us/badges/static/images/badges/es_badge_web_generic.png"
                        alt="Google Play" class="google-play-btn mb-3">
                    <div class="mb-4">
                        <a href="https://play.google.com/store/apps/details?id=org.capacitor.quasar.buroecuador&pcampaignid=web_share"
                            class="download-btn" target="_blank">Descargar APP</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="col-md-6 bg-custom-purple text-white d-flex align-items-center border-radius py-4">
            <div class="container">
                <div class="text-end mb-3">
                    <span class="hashtag">#BuroECUADOR</span>
                </div>
                <h2 class="mb-4">
                    INTERACTÚA <span class="text-thin">con Buró de Crédito Ecuador y conoce todas las herramientas
                        necesarias para tomar el control de tu vida financiera.</span>
                </h2>
                <div class="credit-gauge mb-4">
                    <div class="card bg-custom-purple border-0">
                        <div class="card-body text-center">
                            <img src="{{ asset('img/inicio/planes.png') }}" alt="Credit Score Gauge"
                                class="img-fluid mb-3">
                        </div>
                    </div>
                </div>
                <div class="text-center mb-4">
                    <a href="/servicios" class="buy-plan-btn">Adquirir servicios</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-custom-purple {
        background-color: #3c2b5e;
    }

    .bg-custom-light {
        background-color: #F8F5FF;
        background-color: #eee8ff;
    }

    .border-left {
        border-radius: 16px 0 0 16px;
    }

    .border-radius {
        border-radius: 16px;
    }

    .credit-gauge {
        width: 100%;
        max-width: 300px;
        margin: auto;
    }

    .app-screenshot {
        max-width: 300px;
        margin: auto;
    }

    .google-play-btn {
        max-width: 180px;
    }

    .download-btn {
        background-color: #4B2E83;
        color: white;
        border-radius: 25px;
        padding: 10px 30px;
        border: none;
        text-decoration: none;
    }

    .buy-plan-btn {
        background-color: #F9A825;
        color: white;
        border-radius: 25px;
        padding: 10px 40px;
        border: none;
        text-decoration: none;
    }

    .hashtag {
        background-color: white;
        color: #4B2E83;
        padding: 5px 15px;
        border-radius: 15px;
        display: inline-block;
    }
</style>
