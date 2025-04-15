<template>
    <div>
        <component :is="subirArchivos ? SubirArchivos : Gestor"></component>
    </div>
</template>

<script lang="ts" setup>
// Components
import Gestor from "./modules/gestor/view/GestorArchivosPage.vue"
import SubirArchivos from "./modules/subirArchivos/view/SubirArchivosPage.vue"

// Dependencias
import { useStore } from "vuex"
import { computed } from "@vue/reactivity"

const props = defineProps(["archivos", "carpetas"])

const store = useStore()
const subirArchivos = computed(() => store.state.gestorArchivos.subirArchivos)

store.commit("gestorArchivos/SET_ARCHIVOS", props.archivos.data ?? [])
store.commit("gestorArchivos/SET_CARPETAS", props.carpetas.data ?? [])

</script>
