<template>
    <div v-show="cargando.estaCargando.value" class="cargando">
        <img src="/img/logo.webp" alt="" height="50" class="mb-4" />
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</template>

<script lang="ts">
import { EstadoCargando } from "../application/EstadoCargando.application"
import { defineComponent } from "vue"

export default defineComponent({
    setup() {
        return { cargando: new EstadoCargando() }
    },
})
</script>

<style>
.cargando {
    background-color: rgba(255, 255, 255, 1);
    position: fixed;
    z-index: 2000;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
</style>
