<template>
    <div
        class="btn-group bg-white rounded d-flex flex-wrap flex-grow-1 pt-2"
        role="group"
    >
        <button
            v-for="opcion in modelValue"
            :key="opcion.descripcion"
            :class="
                opcion.estado ? 'btn mx-1 tab-activo' : 'btn mx-1 tab-inactivo'
            "
            :value="opcion.descripcion"
            @click="cambiarEstado($event, opcion)"
        >
            {{ opcion.descripcion }}
        </button>
    </div>
</template>

<script lang="ts">
import { defineComponent } from "vue"

export default defineComponent({
    name: "BotonesSeleccionables",
    props: {
        modelValue: Object,
    },
    setup(props, { emit }) {
        const cambiarEstado = (event, opcion) => {
            emit("update:modelValue", opcion)
        }

        return { cambiarEstado }
    },
})
</script>

<style scoped>
.tab-activo {
    border-bottom: 2px solid #001f3f;
    color: #001f3f;
    font-weight: bold;
    background-color: #ffffff;
}

.tab-inactivo {
    color: #646464;
    background-color: #ffffff;
}

.tab-inactivo:hover {
    border-bottom: 4px solid #ddd;
}
</style>
