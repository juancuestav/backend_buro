<div id="chat" @class(['chat', 'show'=> count($errors)])>
    <div class="header-chat">
        <span>{{ 'Contáctanos' }}</span>
        <i id="cerrarChat" class="bi-x-lg cursor-pointer toggle-chat"></i>
    </div>

    <div class="body-chat desenfoque">
        <form action="{{ route('notificaciones-contacto.store') }}" method="POST">
            @csrf

            {{-- Nombre --}}
            <small class="ps-2 mb-2 d-block">Nombre</small>
            <input type="text" name="nombre"
                class="form-control input-message mb-4 @error('nombre') is-invalid @enderror"
                placeholder="Ingrese su nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
            <span class="invalid-feedback ps-2" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            {{-- Apellidos --}}
            <div class="mb-4">
                <small class="ps-2 mb-2 d-block">Apellidos</small>
                <input type="text" name="apellidos"
                    class="form-control input-message @error('apellidos') is-invalid @enderror"
                    placeholder="Ingrese sus apellidos" value="{{ old('apellidos') }}" required>
                @error('apellidos')
                <span class="invalid-feedback ps-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- Correo --}}
            <div class="mb-4">
                <small class="ps-2 mb-2 d-block">Correo</small>
                <input type="text" name="correo"
                    class="form-control input-message @error('correo') is-invalid @enderror"
                    placeholder="Ingrese su correo" value="{{ old('correo') }}" required>
                @error('correo')
                <span class="invalid-feedback ps-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- Celular --}}
            <div class="mb-4">
                <small class="ps-2 mb-2 d-block">Celular</small>
                <input type="text" name="celular"
                    class="form-control input-message @error('celular') is-invalid @enderror"
                    placeholder="Ingrese su celular" value="{{ old('celular') }}">
                @error('celular')
                <span class="invalid-feedback ps-2" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <small class="ps-2 mb-2 d-block">Mensaje</small>
            <textarea class="input-message mb-4" rows="4" placeholder="Escriba su mensaje" name="mensaje"
                required>{{ old('mensaje') }}</textarea>

            <button class="boton-enviar" type="submit">
                <i class="bi-send me-2"></i>{{ 'Enviar' }}
            </button>
        </form>
    </div>
</div>

@if (session('status'))
<div class="alert alert-success mensaje-enviado">
    {{ session('status') }}
</div>
@endif

{{-- Boton flotante --}}
<button id="abrirChat" class="boton-flotante toggle-chat">¿Cómo podemos ayudarte?<i
        class="bi-chat-dots-fill ms-2"></i></button>

<script>
    // Sólo afecta uno, el boton de mostrar chat :v -_-
    const chat = document.getElementById("chat")
    const abrirChat = document.getElementById("abrirChat")
    abrirChat.addEventListener("click", () => {
        chat.classList.toggle("show")
    })

    const cerrarChat = document.getElementById("cerrarChat")
    cerrarChat.addEventListener("click", () => {
        chat.classList.toggle("show")
    })
    /*Object.values(document.getElementsByClassName("toggle-chat")).forEach((elemento) => {
        elemento.addEventListener("click", () => {
            chat.classList.toggle("show")
        })
    })*/

    /* const textarea = document.querySelector("textarea")
    textarea.addEventListener("keyup", (e) => {
        textarea.style.height = "40px"
        let scHeight = e.target.scrollHeight
        textarea.style.height = `${scHeight}px`
    }) */
</script>

<style>
    .chat {
        position: fixed;
        bottom: 140px;
        right: 24px;
        border: none;
        border-radius: 24px;
        width: 380px;
        overflow: hidden;
        /* background-color: #fff; */
        z-index: 50;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
        display: none;
        opacity: 0;
        transition: all .9s ease;
    }

    .chat .header-chat {
        background-color: #d0d0d0;
        color: #000;
        padding: 12px 16px;
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 1px,
            rgba(0, 0, 0, 0.02) 0px 2px 2px, rgba(0, 0, 0, 0.02) 0px 4px 4px,
            rgba(0, 0, 0, 0.02) 0px 8px 8px, rgba(0, 0, 0, 0.02) 0px 16px 16px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
    }

    .chat .body-chat {
        height: 520px;
        padding: 8px;
        overflow: auto;
    }

    .input-message {
        padding: 8px 16px;
        background-color: #fff;
        border-radius: 8px;
        display: block;
        border: none;
        width: 100%;
        outline: none;
        resize: none;
        max-height: 140px;
        height: 40px;
    }

    textarea::-webkit-scrollbar {
        width: 0;
    }

    .boton-enviar {
        background-color: #6e217f;
        border-radius: 8px;
        border: none;
        outline: none;
        padding: 8px 12px;
        width: 100%;
        color: #fff;
        font-weight: bold;
    }

    .show {
        display: block;
        opacity: 1;
    }

    .boton-flotante {
        background-color: #4a89fa;
        color: #eaecf9;
        border-radius: 24px;
        font-weight: bold;
        border: none;
        outline: none;
        padding: 16px 20px;
        position: fixed;
        bottom: 60px;
        right: 26px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        transition: background-color 0.3s ease, transform 0.1s ease;
    }

    .boton-flotante:active {
        /* background-color: #0056b3; Cambia el color de fondo cuando se hace clic */
        transform: scale(0.95);
        /* Reduce ligeramente el tamaño cuando se hace clic */
    }

    .btn:active {
        /* background-color: #0056b3; Cambia el color de fondo cuando se hace clic */
        transform: scale(0.95);
        /* Reduce ligeramente el tamaño cuando se hace clic */
    }
    .mensaje-enviado {
        position: fixed;
        bottom: 88px;
        right: 26px;
    }

    .desenfoque {
        backdrop-filter: blur(10px);
        background-color: #d0d0d0;
    }
</style>
