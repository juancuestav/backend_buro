<!-- :style="{
            height: 140 * opcionesComp.length - 10 * opcionesComp.length + 'px',
        }" -->
<template>
    <div
        class="floating-container"
        :style="{
            height: opcionesComp.length === 1 ? '140px' : '230px',
        }"
    >
        <div class="floating-button">+</div>
        <div
            v-for="(opcion, index) in opciones"
            :key="index"
            class="element-container d-flex align-items-center"
        >
            <span class="tooltip-dropdown p-1 px-2">{{ opcion.titulo }}</span>
            <span class="float-element" @click="opcion.accion(idCarpetaActual)">
                <i :class="opcion.icono"></i>
            </span>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { OpcionFloatingButton } from "../domain/OpcionFloatingButton"
import { computed, watch } from "vue"

const props = defineProps({
    idCarpetaActual: {
        type: Number as () => number,
        required: false,
    },
    opciones: {
        type: Array as () => OpcionFloatingButton[],
        required: true,
    },
})

const opcionesComp = computed(() => props.opciones)
const totalOpciones = computed(() => props.opciones.length)
/* watch(
    computed(() => props.opciones.length),
    (total) => {
		console.log("dd")
        totalOpciones = total
		console.log(totalOpciones)
    }
)
 */
</script>

<style lang="scss" scoped>
@keyframes come-in {
    0% {
        -webkit-transform: translatey(100px);
        transform: translatey(100px);
        opacity: 0;
    }
    30% {
        -webkit-transform: translateY(50px) scale(0.2);
        transform: translateY(50px) scale(0.2);
    }
    70% {
        -webkit-transform: translateX(0px) scale(1.2);
        transform: translateX(0px) scale(1.2);
    }
    100% {
        -webkit-transform: translateY(0px) scale(1);
        transform: translateY(0px) scale(1);
        opacity: 1;
    }
}

.floating-container {
    position: fixed;
    width: 180px;
    height: 140px;
    bottom: 0;
    right: 0;
    margin: 35px 25px;

    .floating-button {
        position: absolute;
        width: 64px;
        height: 64px;
        background: #96d216;
        border-radius: 50%;
        bottom: 0;
        right: 2px;
        margin: auto;
        color: white;
        line-height: 64px;
        text-align: center;
        font-size: 23px;
        z-index: 100;
        box-shadow: 0 10px 25px -5px rgba(150, 210, 22, 0.6);
        cursor: pointer;
        transition: all 0.3s;
    }

    .float-element {
        position: relative;
        display: block;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin: 15px auto;
        background-color: #1f1f1f;
        color: #fff;
        font-weight: 500;
        text-align: center;
        line-height: 50px;
        z-index: 0;
        opacity: 0;
        cursor: pointer;
        transform: translateY(100px);
    }

    .tooltip-dropdown {
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        opacity: 0;
        background-color: #fff;
        border-radius: 16px;
    }

    &:hover {
        // height: 220px;

        .floating-button {
            box-shadow: 0 10px 25px -5px rgba(88, 122, 14, 0.6);
            transform: translateY(5px);
            transition: all 0.3s;
        }

        .element-container .float-element:nth-child(1) {
            animation: come-in 0.4s forwards 0.2s;
        }
        .element-container .float-element:nth-child(2) {
            animation: come-in 0.4s forwards 0.4s;
        }
        .element-container .float-element:nth-child(3) {
            animation: come-in 0.4s forwards 0.6s;
        }

        .element-container .float-element:hover {
            transform: scale(1.2);
        }

        .tooltip-dropdown {
            animation: come-in 0.4s forwards 0.2s;
        }
    }
}
</style>
