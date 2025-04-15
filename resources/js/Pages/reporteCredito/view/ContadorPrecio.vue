<template>
    <div class="text-center">
        <h4 class="d-inline-block p-2 mb-4 titulo">{{ titulo }}</h4>
        <div class="py-2 mb-3 contador">
            <div ref="color" class="color_fondo" id="fondo_color"></div>
            <div ref="numero" class="numero" id="numero"></div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from "vue"

export default defineComponent({
    props: {
        titulo: {
            type: String,
            required: true,
        },
        valor: {
            type: Number,
            required: true,
        },
    },
    setup(props) {
        const color = ref()
        const numero = ref()

        let cantidad = 0

        onMounted(() => {
            let tiempo = setInterval(() => {
                if (color.value && numero.value) {
                    if (cantidad <= 100)
                        color.value.style.height = `${cantidad}%`
                    numero.value.textContent = "$ " + cantidad
                    if (cantidad === props.valor) {
                        clearInterval(tiempo)
                    }
                    cantidad += 1
                }
            }, 60)
        })

        return {
            color,
            numero,
        }
    },
})
</script>

<style scoped>
.titulo {
    background-color: #2e5496;
    color: #fff;
}
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
    background-color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}

.color_fondo {
    transition: 0.2s;
    transform-origin: bottom;
    position: absolute;
    display: block;
    height: 0%;
    width: 100%;
    /* background-color: #7aa815; */
}
</style>
