<template>
    <div
        v-if="opciones.length"
        class="btn-group dropstart opciones-notificacion"
    >
        <button
            class="btn dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <i class="bi-three-dots-vertical text-color"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li v-for="(opcion, index) in opciones" :key="index">
                <a
                    class="dropdown-item"
                    href="#"
                    @click="opcion.accion(idEntidad)"
                    >{{ opcion.titulo }}
                </a>
            </li>
        </ul>
    </div>
</template>

<style lang="scss">
.opciones-notificacion button::before {
    color: transparent;
}
</style>

<script lang="ts" setup>
import { OpcionDropdown } from "../domain/OpcionDropdown"

defineProps({
    idEntidad: {
        type: Number,
        required: true,
    },
    opciones: {
        type: Array as () => OpcionDropdown[],
        required: true,
    },
})
</script>
