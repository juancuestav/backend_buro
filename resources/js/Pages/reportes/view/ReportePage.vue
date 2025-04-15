<template>
    <component
        :is="mostrarFormulario ? FormularioReporte : ReportePDF"
    ></component>
</template>

<script lang="ts" setup>
// Dependencias
import { computed } from "vue"
import { useStore } from "vuex"

// Componentes
import FormularioReporte from "./FormularioReporte.vue"
import ReportePDF from "./ReportePDF.vue"

const store = useStore()
const mostrarFormulario = computed(() => store.state.reportes.mostrarFormulario)
</script>
