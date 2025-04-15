<template>
    <cargando class="cargando"></cargando>

    <sidebar-layout>
        <h3 class="fs-5 mb-4 fw-bold">
            <i :class="`${iconoPagina} me-2`"></i>Panel de {{ tituloTabla }}
        </h3>
        <p class="text-color">{{ descripcionPagina }}</p>

        <div class="row">
            <!-- Formulario -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">
                        <!-- Agregar cobertura de envío -->
                        <i class="bi-pencil-square me-2"></i>Formulario de
                        {{ tituloTabla }}
                    </div>
                    <div class="card-body p-4">
                        <slot name="formulario" />
                        <button-submits
                            :accion="accion"
                            @cancelar="reestablecer"
                            @editar="editar"
                            @eliminar="eliminar"
                            @guardar="guardar"
                        />
                    </div>
                </div>
            </div>

            <!-- Listado -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi-list me-2"></i>Listado de {{ tituloTabla }}
                    </div>
                    <div class="card-body p-4">
                        <listado
                            :configuracion-columnas="columnas"
                            :elementos="listado"
                        ></listado>
                    </div>
                </div>
            </div>
        </div>
    </sidebar-layout>
</template>

<script lang="ts" setup>
// Dependencias
import { EventosTabla } from "../domain/eventosTabla.domain"

// Componentes
import ButtonSubmits from "@components/ButtonSubmits.vue"
import Cargando from "@components/cargando/view/Cargando.vue"
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import Listado from "@components/listado/Listado.vue"
import { ref, onBeforeUnmount } from "vue"

const props = defineProps({
    configuracionColumnas: {
        required: true,
        type: Array,
    },
    mixin: {
        type: Object as () => ContenedorMixin,
        required: true,
    },
    contextMenu: {
        type: Array,
        required: false,
    },
    descripcionPagina: {
        type: String,
        required: true,
    },
    iconoPagina: {
        type: String,
        required: true,
    },
    puedeConsultar: {
        type: Boolean,
        default: true,
    },
    puedeEditar: {
        type: Boolean,
        default: true,
    },
    puedeEliminar: {
        type: Boolean,
        default: true,
    },
})

const mixin = props.mixin

const { accion, listado } = mixin.useReferencias()
const { guardar, editar, eliminar, reestablecer, listar } =
    mixin.useComportamiento()

const eventosAdmitidos = {
    consultar: props.puedeConsultar,
    editar: props.puedeEditar,
    eliminar: props.puedeEliminar,
}

const eventosTabla = new EventosTabla(
    mixin,
    accion,
    eventosAdmitidos
).obtenerBotonesEventos()
const columnas = [...eventosTabla, ...props.configuracionColumnas]

const tituloTabla = location.pathname
    .split("/")[2]
    ?.toString()
    .toLowerCase()
    .replace("-", " ")

if (!props.contextMenu) listar()
</script>
