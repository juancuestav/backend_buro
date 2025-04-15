<template>
    <sidebar-layout>
        <h3 class="fs-5 mb-4 fw-bold">
            <i class="bi-menu-button-wide me-2"></i>Acceso a consultas
        </h3>
        <p class="text-color mb-4">
            Todas tus herramientas en un único sitio. Crea accesos directos a
            tus herramientas más usadas.
        </p>

        <div class="d-flex justify-content-between align-items-center">
            <div class="form-check form-switch">
                <input
                    v-model="editarAccesosDirectos"
                    class="form-check-input"
                    type="checkbox"
                    id="editar"
                />
                <label class="form-check-label" for="editar">
                    Editar accesos directos
                </label>
            </div>

            <span v-if="editarAccesosDirectos">
                <button
                    class="btn btn-success text-white me-2"
                    @click="agregarFila()"
                >
                    <i class="bi-plus me-2"></i>Agregar nuevo
                </button>
                <button class="btn btn-primary" @click="guardar()">
                    <i class="bi-save me-2"></i>Guardar
                </button>
            </span>
        </div>

        <listado
            v-show="editarAccesosDirectos"
            ref="refAccesos"
            :configuracion-columnas="columnas"
            :elementos="accesosDirectos"
            :context-menu="contextMenu"
            :permitir-ocultar-columnas="false"
            :permitir-exportar="false"
            :alto-fijo="false"
        ></listado>

        <div v-show="!editarAccesosDirectos" class="pt-3">
            <a
                v-for="(acceso, index) in accesosDirectos"
                :key="index"
                :href="acceso.url"
                target="_blank"
                class="btn btn-success text-white d-block mb-2"
                >{{ acceso.nombre_acceso }}</a
            >
        </div>
    </sidebar-layout>
</template>

<script lang="ts" setup>
// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { EventosTablaEliminar } from "../domain/EventosTablaEliminar"
import { ContextMenuFilasDinamicas } from "@/shared/contenedor/domain/ContextMenuFilasDinamicas"
import { ref, Ref, computed, watchEffect, onMounted } from "vue"
import { AccesoDirecto } from "../domain/AccesoDirecto"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Listado from "@components/listado/Listado.vue"
import { useNotificaciones } from "@/shared/components/toastification/application/notificaciones"
import { sleep } from "@/shared/utils"

// const props = defineProps(["accesosDirectos"])
// console.log(props.accesosDirectos)

const editarAccesosDirectos = ref(false)
const refAccesos = ref()

const accesosDirectos: Ref<AccesoDirecto[]> = ref([])
const contextMenu = new ContextMenuFilasDinamicas(
    accesosDirectos,
    AccesoDirecto
).obtenerContextMenu()

onMounted(() => {
    setTimeout(() => {
        const listado = localStorage.getItem("accesosDirectos")

        if (listado) {
            accesosDirectos.value = JSON.parse(listado)
        }

        /* const accesoPredeterminado = new AccesoDirecto()
        accesoPredeterminado.nombre_acceso = "Google"
        accesoPredeterminado.url = "https://www.google.com" */
    }, 500)

    // refAccesos.value.actualizar()
    /* if (accesosDirectos.value.length === 0) {
        setTimeout(() => (accesosDirectos.value = [accesoPredeterminado]), 500)
    } */
})

async function guardar() {
    /* const data = accesosDirectos.value.reduce(
        (a, v) => ({ ...a, [v.nombre_acceso]: v.url }),
        {}
    ) */
    localStorage.setItem(
        "accesosDirectos",
        JSON.stringify(accesosDirectos.value)
    )
    const { notificarCorrecto } = useNotificaciones()
    await sleep(0)
    notificarCorrecto("Guardado exitosamente!")
    // console.log(data)
}

function agregarFila() {
    accesosDirectos.value = [...accesosDirectos.value, new AccesoDirecto()]
}

const columnas = [
    ...new EventosTablaEliminar(accesosDirectos).obtenerBotonesEventos(),
    ...configuracionColumnas,
]
</script>
