<?php
use App\Models\Sistema\ConfiguracionGeneral;
$configuracion_general = ConfiguracionGeneral::first();
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo.webp') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <style>
        .social-networks {
            position: fixed;
            bottom: 140px;
            right: 0;
            padding-left: 0;
            display: flex;
            flex-direction: column;
            gap: 32px;
            opacity: 1;
            transition: all .5s ease;
            right: 18px;
        }

        /* .social-networks-show {
            z-index: 9000;
            right: 16px;
            opacity: 1;
        } */
        /* Instagram CSS Linear Gradient Background */
        .gradient-instagram {
            background: #833ab4;
            background: linear-gradient(to right,
                    #833ab4, #fd1d1d, #fcb045);
        }
    </style>

    <!-- Google tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-238446628-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-238446628-1');
    </script>

    {{-- Google Adsense --}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6980207264038332"
        crossorigin="anonymous"></script>

    @yield('css')
</head>

<body>
    <x-navbar></x-navbar>

    <main class="position-relative">
        @yield('content')
    </main>

    <x-footer></x-footer>
    <x-chat></x-chat>

    <input type="hidden" name="whatsapp" value="{{ $configuracion_general['whatsapp'] }}">
    <div class="social-networks">
        {{-- <div>
        <a href="https://play.google.com/store/apps/details?id=org.cordova.quasa.buroapp" target="_blank"
            class="p-3 text-white shadow-sm rounded-circle" style="background-color: #fff;">
            <svg xmlns="http://www.w3.org/2000/svg" height="30" width="20" id="svg60" version="1.1"
                viewBox="-4.12599 -7.65905 35.75858 45.9543">
                <defs id="defs38">
                    <linearGradient gradientUnits="userSpaceOnUse" y2="21.86" x2="-5.9" y1="1.87" x1="14.09"
                        id="linear-gradient">
                        <stop id="stop4" stop-color="#008eff" offset="0" />
                        <stop id="stop6" stop-color="#008fff" offset=".01" />
                        <stop id="stop8" stop-color="#00acff" offset=".26" />
                        <stop id="stop10" stop-color="#00c0ff" offset=".51" />
                        <stop id="stop12" stop-color="#00cdff" offset=".76" />
                        <stop id="stop14" stop-color="#00d1ff" offset="1" />
                    </linearGradient>
                    <linearGradient gradientUnits="userSpaceOnUse" y2="15.32" x2="-2.37" y1="15.32" x1="26.45"
                        id="linear-gradient-2">
                        <stop id="stop17" stop-color="#ffd800" offset="0" />
                        <stop id="stop19" stop-color="#ff8a00" offset="1" />
                    </linearGradient>
                    <linearGradient gradientUnits="userSpaceOnUse" y2="45.15" x2="-9.41" y1="18.05" x1="17.69"
                        id="linear-gradient-3">
                        <stop id="stop22" stop-color="#ff3a44" offset="0" />
                        <stop id="stop24" stop-color="#b11162" offset="1" />
                    </linearGradient>
                    <linearGradient gradientUnits="userSpaceOnUse" y2="3.81" x2="8.92" y1="-8.29" x1="-3.19"
                        id="linear-gradient-4">
                        <stop id="stop27" stop-color="#328e71" offset="0" />
                        <stop id="stop29" stop-color="#2d9571" offset=".07" />
                        <stop id="stop31" stop-color="#15bd74" offset=".48" />
                        <stop id="stop33" stop-color="#06d575" offset=".8" />
                        <stop id="stop35" stop-color="#00de76" offset="1" />
                    </linearGradient>
                    <style id="style2">
                        .cls-7 {
                            opacity: .07
                        }
                    </style>
                </defs>
                <g transform="translate(.004)" id="g58">
                    <g id="g56">
                        <path id="path40"
                            d="M.55.48A2.39 2.39 0 000 2.15v26.34a2.41 2.41 0 00.55 1.67l.09.09 14.75-14.76v-.35L.64.39z"
                            fill="url(#linear-gradient)" />
                        <path id="path42"
                            d="M20.31 20.41l-4.92-4.92v-.35l4.92-4.91.11.06 5.83 3.31c1.67.94 1.67 2.49 0 3.44l-5.83 3.31z"
                            fill="url(#linear-gradient-2)" />
                        <path id="path44" d="M20.42 20.35l-5-5L.55 30.16a2 2 0 002.45.07l17.39-9.88"
                            fill="url(#linear-gradient-3)" />
                        <path id="path46" d="M20.42 10.29L3 .4A1.93 1.93 0 00.55.48l14.84 14.84z"
                            fill="url(#linear-gradient-4)" />
                        <path id="path48"
                            d="M20.31 20.24L3 30.06a2 2 0 01-2.39 0l-.09.09.09.09a2 2 0 002.39 0l17.39-9.88z"
                            opacity=".1" />
                        <path id="path50" d="M.55 30A2.43 2.43 0 010 28.32v.17a2.41 2.41 0 00.55 1.67l.09-.09z"
                            class="cls-7" />
                        <path id="path52"
                            d="M26.25 16.86l-5.94 3.38.11.11L26.25 17a2.11 2.11 0 001.25-1.72 2.21 2.21 0 01-1.25 1.58z"
                            class="cls-7" />
                        <path id="path54"
                            d="M3 .58l23.25 13.19a2.2 2.2 0 011.25 1.55 2.09 2.09 0 00-1.25-1.72L3 .4C1.36-.54 0 .24 0 2.15v.17C0 .42 1.36-.37 3 .58z"
                            fill="#fff" opacity=".3" />
                    </g>
                </g>
            </svg>
        </a>
    </div> --}}

        @if ($configuracion_general['whatsapp'])
            <div class="boton-whatsapp">
            </div>
        @endif

        {{-- NO BORRAR - GENERAR CON LA CONFIGURACION GENERAL DE LA APLICACION --}}
        @if ($configuracion_general['facebook'])
            <div>
                <a href="{{ $configuracion_general['facebook'] }}" class="p-3 text-white shadow-sm rounded-circle"
                    target="_blank" style="background-color: #0088ff;"><i class="bi-facebook"></i></a>
            </div>
        @endif

        @if ($configuracion_general['instagram'])
            <div>
                <a href="{{ $configuracion_general['instagram'] }}" target="_blank"
                    class="p-3 text-white shadow-sm rounded-circle gradient-instagram"><i class="bi-instagram"></i></a>
            </div>
        @endif

        @if ($configuracion_general['twitter'])
            <div>
                <a href="{{ $configuracion_general['twitter'] }}" target="_blank"
                    class="p-3 bg-black text-white shadow-sm rounded-circle"><i class="bi-twitter-x"></i></a>
            </div>
        @endif
        {{-- NO BORRAR - GENERAR CON LA CONFIGURACION GENERAL DE LA APLICACION --}}
    </div>

    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    {{-- <script>
    window.addEventListener('scroll', function() {
        let header = document.querySelector('.social-networks');
        let windowPosition = window.scrollY > 1;
        header.classList.toggle('social-networks-show', windowPosition);
    })
</script> --}}

    {{-- Boton whatsapp --}}
    <script>
        const botonWhatsapp = document.getElementsByClassName("boton-whatsapp")[0]

        if (botonWhatsapp) {
            const link = document.createElement("a")
            const celular = "0" + document.getElementsByName("whatsapp")[0].value
            const phone = "593" + celular.substring(1, celular.length)

            if (window.innerWidth < 768) {
                // link.href = `https://api.whatsapp.com/send?phone=${phone}`
                link.href = `https://api.whatsapp.com/send?phone=${phone}&text=Quiero%20mas%20informacion%20de%20mi%20buro%20de%20credito%20`
            } else {
                link.href =    `https://web.whatsapp.com/send?phone=${phone}&text=Quiero%20mas%20informacion%20de%20mi%20buro%20de%20credito%20`
                // link.href = `https://web.whatsapp.com/send?phone=${phone}`
            }

            link.target = "_blank"
            link.classList.add("p-3", "text-white", "shadow-sm", "rounded-circle")
            link.style.backgroundColor = "#0dc143"

            // icono
            const i = document.createElement("i")
            i.classList.add("bi-whatsapp")

            link.appendChild(i)

            botonWhatsapp.appendChild(link)
        }
    </script>

    @yield('js')
</body>

</html>
