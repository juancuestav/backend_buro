<nav id="navbar"
    class="navbar navbar-expand-lg sticky-top bg-morado navbar-dark custom-navbar d-flex justify-content-between">

    <a class="navbar-brand d-flex align-items-center ps-4" href="{{ route('inicio') }}">
        <img src="{{ asset('img/buro.png') }}" alt="logo empresa" class="rounded me-2" width="40">
        <div class="text-thin show-desktop">Buró de Crédito Ecuador</div>
    </a>

    <div class="pe-4">
        <a href="https://app.burodecredito.ec/login"
            class="btn btn-primary rounded-card text-morado fw-bold mobile-login" target="_blank">Ingresar</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <div class="collapse navbar-collapse text-white" id="navbarNav">
        <div class="w-100 menu-navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('soluciones-empresas') ? 'active fw-bold li-active' : '' }}"
                        aria-current="page" href="{{ route('soluciones-empresas') }}">Soluciones empresas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inicio') ? 'active fw-bold li-active' : '' }}"
                        aria-current="page" href="{{ route('inicio') }}">Inicio</a>
                </li>

                <li class="nav-item text-white">
                    <a class="nav-link {{ request()->routeIs('planes.index') ? 'active fw-bold li-active' : '' }}"
                        aria-current="page" href="{{ route('planes.index') }}">Score crediticio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('mejoramiento') ? 'active fw-bold li-active' : '' }}"
                        aria-current="page" href="{{ route('mejoramiento') }}">Mejoramiento</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('reporte-credito') ? 'active fw-bold li-active' : '' }}"
                        aria-current="page" href="{{ route('reporte-credito') }}">Reporte crédito</a>
                </li>

                <li id="boton_servicios" class="nav-item">
                    <a class="nav-link dropdown-toggle toggle-contenedor-listados" href="#" id="navbarUsuario">
                        <b>Servicios</b>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contacto') ? 'active fw-bold li-active' : '' }}"
                        href="{{ route('contacto') }}">Contacto</a>
                </li>

                {{-- <li class="nav-item me-2">
                    <a class="nav-link {{ request()->routeIs('ubicanos') ? 'active fw-bold li-active' : '' }}"
                        href="{{ route('ubicanos') }}">Ubícanos</a>
                </li> --}}

                {{-- <li class="nav-item me-2">
                    <a class="nav-link" href="https://bit.ly/3IwT5sX" target="_blank">
                        <i class="bi-check-circle-fill me-2"></i> Consulta de solicitud de crédito
                    </a>
                </li> --}}

                <li class="nav-item me-2">
                    <a class="nav-link" href="{{ route('solicitud_credito.index') }}">Solicitud de crédito</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('politicas-privacidad') ? 'active fw-bold li-active' : '' }}"
                        href="{{ route('politicas-privacidad') }}">Políticas de privacidad</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <a class="me-2 btn btn-primary text-morado fw-bold text-nowrap px-3 mb-2 show-desktop" target="_blank"
                    href="https://app.burodecredito.ec/login">
                    Ingresar
                </a>

                <a class="nav-link btn btn-outline-primary text-primary fw-bold text-nowrap px-3 mb-2 show-desktop"
                    target="_blank" href="https://app.burodecredito.ec/register">
                    Registrarme
                </a>
            </ul>
        </div>
    </div>
</nav>

<div class="position-relative text-center mx-auto" style="z-index: 10">
    <div id="backdrop"></div>
    <div id="contenedor_servicios" class="mx-auto w-100"></div>
</div>

<div class="bg-morado text-white py-2">
    <div class="container">
        <h1>Toma el control de tu <span class="text-morado bg-white">vida crediticia</span>
        </h1>
        <h4 style="font-size: 24px;" class="text-thin">Con nuestras soluciones:</h4>
    </div>
</div>

<script>
    window.addEventListener('scroll', function() {
        let header = document.querySelector('nav');
        let windowPosition = window.scrollY > 0;
        header.classList.toggle('scrolling-active', windowPosition);
    })
</script>

<script>
    const seccionServicios = document.getElementById("boton_servicios");
    const navbarNav = document.getElementById("navbarNav");
    const backdrop = document.getElementById('backdrop');

    seccionServicios.addEventListener("click", () => toggleServicios());
    backdrop.addEventListener("click", () => toggleServicios());

    let colapsado = true;

    function toggleServicios() {
        const contenedorServicios = document.getElementById("contenedor_servicios")
        const backdrop = document.getElementById("backdrop")

        if (colapsado) {
            contenedorServicios.style.top = "0";
            navbarNav.classList.remove("show")

            backdrop.classList.add("backdrop");
        } else {
            contenedorServicios.style.top = "-2800px";
            backdrop.classList.remove("backdrop");
        }
        colapsado = !colapsado;
    }

    async function obtenerServicios() {
        const ruta = window.location.origin + '/servicios/todos';
        const response = await fetch(ruta, {});
        const data = (await response.json())
        generarListado(data)

        const botonCerrarServicios = document.getElementById("boton_cerrar_servicios");
        botonCerrarServicios.addEventListener("click", () => toggleServicios());
    }

    function generarListado(data) {
        // const navbar = document.querySelector(".navbar");

        const contenedorServicios = document.getElementById("contenedor_servicios")
        contenedorServicios.classList.add("seccion-servicios", "row", "g-0", "shadow-sm"); //, "opacity-0");
        contenedorServicios.style.top = "-2800px";
        contenedorServicios.style.zIndex = "-10";

        const col1 = document.createElement("div");
        col1.classList.add("col-md-8");

        const col2 = document.createElement("div");
        col2.classList.add("col-md-4", "col-robot");

        const rowCol1 = document.createElement("div");
        rowCol1.classList.add("row", "p-4");

        for (let item of data.data) {
            const col = generarColSeccion(item.nombre_categoria, item.id_categoria, item.values);
            rowCol1.appendChild(col);
        }

        col1.appendChild(rowCol1);
        col2.appendChild(generarLottieHTML());
        contenedorServicios.appendChild(col1);
        contenedorServicios.appendChild(col2);
    }

    function generarColSeccion(nombreCategoria, idCategoria, servicios) {
        const col = document.createElement("div");
        col.classList.add("col-md-6", "px-2");

        const small = document.createElement("h5");
        small.innerHTML = nombreCategoria;
        small.classList.add("categoria");

        const ul = document.createElement("ul");
        ul.classList.add("listado", "h-100");

        for (let servicio of servicios) {
            const ruta = window.location.origin + "/servicios/" + servicio.id;
            const li = generarItemServicio(servicio.nombre, ruta);
            ul.appendChild(li);
        }

        const ruta = window.location.origin + "/servicios?categoria=" + idCategoria;
        const li = generarItemCategoria("Conocer más", ruta);
        ul.appendChild(li);

        col.appendChild(small);
        col.appendChild(ul);

        return col;
    }

    function generarItemServicio(nombre, ruta) {
        const li = document.createElement("li");
        const a = document.createElement("a");
        const icono = document.createElement("i");
        icono.classList.add("bi-app-indicator", "me-2", 'icono-menu', 'gradiente-azul-morado', 'text-white');

        li.classList.add("servicio");
        a.href = ruta;
        a.innerHTML = nombre;

        li.appendChild(icono);
        li.appendChild(a);
        return li;
    }

    function generarItemCategoria(nombreCategoria, ruta) {
        const li = document.createElement("li");
        const a = document.createElement("a");
        const icono = document.createElement("i");
        icono.classList.add("bi-chevron-right", "ms-2");

        li.classList.add("mt-4", 'text-start', 'mb-4'); //, "position-absolute", "bottom-0");
        a.classList.add("btn", "btn-primary", 'rounded-pill', 'px-4', 'fw-bold');
        a.href = ruta;
        a.innerHTML = nombreCategoria;

        a.appendChild(icono);
        li.appendChild(a);
        return li;
    }

    function generarLottieHTML() {
        const div = document.createElement("div");
        div.classList.add("d-flex", "align-items-center", "flex-column", 'menu-right-section');

        // Lottie
        const lottiePlayer = document.createElement("lottie-player");
        lottiePlayer.src = "/img/lottie/robot.json";
        lottiePlayer.background = "transparent";
        lottiePlayer.speed = "1";
        lottiePlayer.style = "width: 140px; height: 140px;"
        lottiePlayer.setAttribute("loop", true);
        lottiePlayer.setAttribute("autoplay", true);

        // Texto
        const texto = document.createElement("p");
        // texto.classList.add("text-white");
        texto.innerText = "Adquiere tu informe de crédito";

        // Boton
        const boton = document.createElement("a");
        boton.classList.add("btn", "btn-sm", "btn-secondary", 'rounded-pill', 'px-3', 'fw-bold', 'mb-2');
        boton.innerText = "Conoce todos nuestros servicios";
        boton.href = window.location.origin + "/servicios";

        // Boton cerrar
        const cerrar = document.createElement('a')
        cerrar.setAttribute('id', 'boton_cerrar_servicios');
        cerrar.classList.add("btn", "btn-sm", 'btn-outline-light', 'px-3', 'rounded-pill', 'fw-bold', 'mb-4');
        cerrar.innerHTML = '<i class="bi-x-lg me-2"></i>Cerrar menú';

        // Div hrizontal
        /*const divHorizontal = document.createElement('div');
        divHorizontal.classList.add('d-flex', 'justify-content-end', 'w-75');
        divHorizontal.appendChild(cerrar);*/

        div.appendChild(lottiePlayer);
        div.appendChild(texto);
        div.appendChild(boton);
        div.appendChild(cerrar);
        return div;
    }

    window.onload = obtenerServicios()

    const navbar = document.getElementById('navbar');
    let isScrolling = false;

    window.addEventListener('scroll', () => {
        if (!isScrolling) {
            window.requestAnimationFrame(() => {
                if (window.scrollY > 10) {
                    navbar.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.1)';
                } else {
                    navbar.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0)';
                }
                isScrolling = false;
            });
            isScrolling = true;
        }
    });
</script>

<style>
    .seccion-servicios {
        position: absolute;
        background-color: #251a38;
        color: #fff;
        width: 75%;
        border-bottom: 1px dashed #ffffff;
        border-radius: 0 0 16px 16px;
        border-top: 1px solid #0000001f;
        margin: auto;
        left: 0;
        right: 0;
    }

    .seccion-servicios .listado {
        list-style: none;
        position: relative;
        left: -32px;
        color: #fff;
    }

    /* Titulo de categorias */
    .seccion-servicios .categoria {
        display: inline-block;
        margin-bottom: 16px;
        text-align: left;
        width: 100%;
        font-weight: bold;
        /* color: #4de961; */
    }

    .seccion-servicios .servicio {
        text-align: left;
        width: 100%;
        color: inherit;
        padding: 14px;
        /* background-color: purple; */
    }

    .seccion-servicios .servicio a {
        text-decoration: none;
        color: inherit;
    }

    .seccion-servicios .servicio:hover {
        /* text-decoration: none; */
        background-color: #68686f0d;
        cursor: pointer;
    }

    .col-robot {
        border-left: 1px dashed #000;
        /* padding: 16px; */
    }

    #contenedor_servicios {
        transition: all .3s ease;
    }

    #backdrop {
        transition: all .3s ease;
    }
</style>

<style>
    .empresa {
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
    }

    .nav-link {
        position: relative;
        text-align: center;
        margin-right: 4px;
        transition: transform 0.2s ease;
        color: #fff !important;
    }

    /* .nav-link::before {
        content: '';
        width: 100%;
        height: 2px;
        background-color: #96d216;
        position: absolute;
        left: 0;
        bottom: 0;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .5s ease;
    } */

    /* .nav-link:hover::before {
        background-color: #ddd;
        transform: scaleX(1);
    } */

    .nav-link.active::before {
        transform: scaleX(1);
    }

    @media (max-width: 768px) {

        .dropdown-item {
            text-align: center;
        }

        .empresa {
            display: none;
        }
    }

    /* Navbar normal */
    .custom-navbar {
        padding: 1rem 0;
        transition: padding .2s ease;
        color: #fff !important;

    }

    /* Navbar colapsado */
    .scrolling-active {
        padding: .6rem 0;
        background-color: #3c2b5e !important;
    }

    /* carrito */
    .menu {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .link {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 99em;
        position: relative;
        z-index: 1;
        overflow: hidden;
        transform-origin: center left;
        transition: width 0.2s ease-in;
        text-decoration: none;
        color: inherit;
    }

    .link:before {
        position: absolute;
        z-index: -1;
        content: "";
        display: block;
        border-radius: 99em;
        width: 100%;
        height: 100%;
        top: 0;
        transform: translateX(100%);
        transition: transform 0.2s ease-in;
        transform-origin: center right;
        background-color: transparent;
        border: 1px solid #00000033;
    }

    .link:hover,
    .link:focus {
        outline: 0;
        width: 130px;
    }

    .link:hover:before,
    .link:hover .link-title,
    .link:focus:before,
    .link:focus .link-title {
        transform: translateX(0);
        opacity: 1;
    }

    .link-icon {
        display: block;
        flex-shrink: 0;
        left: 18px;
        position: absolute;
    }

    .link-title {
        transform: translateX(100%);
        transition: transform 0.2s ease-in;
        transform-origin: center right;
        display: block;
        text-align: center;
        width: 100%;
    }

    .items-navbar {
        list-style: none;
    }

    .iniciar-sesion {
        background-color: #eee;
    }
</style>

<style>
    .boton-cerrar {
        /* position: relative; */
        /* bottom: -48px; */

    }

    # . {
        display: block;
    }

    @media (max-width: 768px) {
        .boton-descargar {
            width: 100%;
        }
    }

    @media (min-width: 768px) {
        .mobile-login {
            display: none;
        }
    }

    /* Ocultar por defecto en dispositivos móviles */
    .show-desktop {
        display: none;
    }

    /* Mostrar en pantallas de escritorio (768px en adelante) */
    @media (min-width: 768px) {
        .show-desktop {
            display: inline-block;
        }
    }


    .backdrop {
        position: fixed;
        top: 0;
        background-color: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100vh;
        z-index: -50;
    }

    .icono-menu {
        /* background-color: #ffffff; */
        /* color: #6e217f; */
        padding: 8px;
        border-radius: 4px;
    }

    .menu-right-section {
        background: #68686f0b;
        height: 100%;
    }

    .li-active {
        border-bottom: 2px solid #f8aa1a;
    }

    .menu-navbar {
        display: flex;
        justify-content: center;
        background-color: #251a38;
        padding: 16px 0;
        margin-top: 8px;
    }

    /* Mostrar en pantallas de escritorio (768px en adelante) */
    @media (min-width: 768px) {
        .menu-navbar {
            display: flex;
            justify-content: flex-end;
            background-color: inherit;

        }
    }

    h1 {
        font-size: 44px;
        /* Tamaño grande por defecto (para computadoras) */
    }

    /* Cuando la pantalla es de 768px o menos (celulares y tablets) */
    @media (max-width: 768px) {
        h1 {
            font-size: 28px;
            /* Tamaño más pequeño para móviles */
        }
    }
</style>
