@props(['titulo', 'cantidad'])

    <h6 class="mb-5 text-center">{{ $titulo }}</h6>
    <div class="py-4 mb-4 contador">
        <div class="color_fondo"></div>
        <div class="numero"></div>
    </div>

<script>
    const color = document.getElementsByClassName('color_fondo')[0]
    const numero = document.getElementsByClassName('numero')[0]
    let cantidad = 0
    let tiempo = setInterval(() => {

        cantidad += 1

        // if (cantidad <= 100) color.style.height = `${cantidad}%`
        numero.textContent = cantidad
        if (cantidad === 999) {
            cantidad = 1;
        }
    }, 100);
</script>

<style>
    .contador {
        height: 60px;
        width: 100%;
        transform: rotate(180deg);
        position: relative;
    }

    .numero {
        height: 100%;
        width: 100%;
        text-align: center;
        font-size: 60px;
        font-weight: bold;
        font-family: sans-serif;
        color: #000;
        position: absolute;
        transform: rotate(-180deg);
        mix-blend-mode: screen;
        /* background-color: #fff; */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .color_fondo {
        transition: .2s;
        transform-origin: bottom;
        position: absolute;
        display: block;
        height: 0%;
        width: 100%;
        background-color: #7aa815;
    }
</style>
