<footer class="footer bg-morado text-white pt-5">
    <div class="container">
        <!-- Top Section -->
        <div class="row">
            <!-- Logo Section -->
            <div class="col-md-3 mb-4">
                <div class="logo-container">
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('inicio') }}">
                        <img src="{{ asset('img/buro.png') }}" alt="logo empresa" class="rounded mb-0 me-2" width="40">
                        <span class="text-thin">Buró de Crédito Ecuador</span>
                    </a>
                    <a target="_blank"
                        href="https://play.google.com/store/apps/details?id=org.capacitor.quasar.buroecuador&pcampaignid=web_share">
                        <img src="{{ asset('img/inicio/google-play.png') }}" alt="Disponible en Google Play"
                            class="img-fluid" style="max-height: 60px;">
                    </a>
                </div>
            </div>

            <!-- Links Sections -->
            <div class="col-md-3 mb-4">
                <h3 class="footer-title">Nuestras soluciones</h3>
                <ul class="list-unstyled text-thin">
                    <li><a href="{{ route('inicio') }}">Buró de Crédito Ecuador</a></li>
                    <li><a href="https://bit.ly/SOLIBRC">Solicitud de crédito</a></li>
                </ul>
            </div>

            <div class="col-md-3 mb-4">
                <h3 class="footer-title">Legal</h3>
                <ul class="list-unstyled text-thin">
                    <li><a href="{{ route('politicas-privacidad') }}">Política de privacidad</a></li>
                    <li><a href="{{ route('politicas-privacidad') }}">Términos y condiciones</a></li>
                </ul>
            </div>

            <div class="col-md-3 mb-4">
                <h3 class="footer-title">Contáctanos</h3>
                <ul class="list-unstyled text-thin">
                    <li><a href="{{ route('mejoramiento') }}">Preguntas frecuentes</a></li>
                    <li><a href="{{ route('contacto') }}">Contáctanos</a></li>
                </ul>
            </div>
        </div>

        <!-- Company Info -->
        <div class="border-top border-light pt-4">
            <div class="row align-items-center mb-4">
                <div class="col-lg-8 mb-3 mb-lg-0 text-center text-lg-start text-thin">
                    <p class="mb-1">2025 <b>Buró de Crédito Ecuador</b> © Derechos reservados.</p>
                    <p class="mb-1">Matriz</p>
                    <p class="mb-1">Edificio Orellana Piso 3 oficina 5, Los Rios 609 & Quisquis, Guayaquil</p>
                    <p class="mb-0">Email: atencionclientes@burodecredito.ec</p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <!-- Facebook -->
                    @if (Config::get('buro.facebook'))
                        <a class="btn text-white m-1" href="{{ Config::get('buro.facebook') }}" role="button"
                            target="_blank"><i class="bi-facebook fs-4"></i></a>
                    @endif

                    <!-- Instagram -->
                    @if (Config::get('buro.instagram'))
                        <a class="btn text-white m-1" href="{{ Config::get('buro.instagram') }}" role="button"
                            target="_blank"><i class="bi-instagram fs-4"></i></a>
                    @endif

                    <!-- Twitter -->
                    @if (Config::get('buro.twitter'))
                        <a class="btn text-white m-1" href="{{ Config::get('buro.twitter') }}" role="button"
                            target="_blank"><i class="bi-twitter-x fs-4"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="border-bottom"></div>
    <!-- Legal Disclaimers -->
    <div class="legal-disclaimers bg-morado-oscuro text-thin">
        <div class="container py-4">
            <p class="small">¹ Impacto de Buró de Crédito Ecuador en la vida financiera de los Ecuatorianos. Muestra
                estadística de <b>más de 5.000</b> usuarios activos en el portal que respondieron la encuesta.</p>
            <p class="small">² Todas las funcionalidades expuestas en esa sección, son <b>funcionalidades</b> son
                <b>pagas</b> y
                las puedes adquirir comprando una <b>suscripción</b> desde el portal web.
            </p>
            <p class="small">³ Buró de Crédito Ecuador <b>no origina créditos</b> ni asume <b>responsabilidad</b> por
                la aprobación o
                rechazo de
                créditos ofrecidos por entidades financieras.</p>
        </div>
    </div>
</footer>

<style>
    .footer-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.2rem;
    }

    .footer ul li {
        margin-bottom: 0.5rem;
    }

    .footer a {
        color: white;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }

    .footer a:hover {
        opacity: 0.8;
        text-decoration: underline;
    }

    .logo-container img {
        display: block;
        margin-bottom: 1rem;
    }

    .border-light {
        border-color: rgba(255, 255, 255, 0.2) !important;
    }

    .legal-disclaimers {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.875rem;
    }

    .legal-disclaimers p {
        margin-bottom: 0.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .footer-title {
            margin-top: 1rem;
        }

        .logo-container {
            text-align: center;
        }

        .logo-container img {
            margin: 0 auto 1rem;
        }
    }
</style>
