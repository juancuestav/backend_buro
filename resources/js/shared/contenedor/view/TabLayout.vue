<template>
    <sidebar-layout>
        <h3 class="fs-5 mb-4 fw-bold">
            <i :class="`${iconoPagina} me-2`"></i>Panel de {{ tituloTabla }}
        </h3>
        <p class="text-color">{{ descripcionPagina }}</p>

        <!-- Tabs pestañas -->
        <div class="contenedor-tabs">
            <div class="d-flex">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li
                        v-if="mostrarTabFormulario"
                        class="nav-item"
                        role="presentation"
                    >
                        <button
                            class="nav-link"
                            :class="{ active: tabIndex === 0 }"
                            data-bs-toggle="pill"
                            data-bs-target="#firstTab"
                            type="button"
                            role="tab"
                            @click="tabIndex = 0"
                        >
                            <i
                                class="bi-record-circle-fill text-success me-2"
                            ></i
                            >Formulario
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            :class="{ active: tabIndex === 1 }"
                            data-bs-toggle="pill"
                            data-bs-target="#secondTab"
                            type="button"
                            role="tab"
                            @click="tabIndex = 1"
                        >
                            <i
                                class="bi-record-circle-fill text-success me-2"
                            ></i
                            >Listado
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contenido de los tabs -->
        <div class="tab-content" id="pills-tabContent">
            <!-- Tab 1 -->
            <div
                class="tab-pane fade show"
                :class="{ active: tabIndex === 0 }"
                id="firstTab"
                role="tabpanel"
            >
                <div class="card">
                    <div class="card-body p-4">
                        <slot name="formulario" />
                        <button-submits
                            v-if="mostrarButtonSubmits"
                            :accion="accion"
                            @cancelar="reestablecer"
                            @editar="editar"
                            @eliminar="eliminar"
                            @guardar="guardar"
                        />
                    </div>
                </div>
            </div>

            <!-- Tab 2 -->
            <div
                class="tab-pane fade show"
                :class="{ active: tabIndex === 1 }"
                id="secondTab"
                role="tabpanel"
            >
                <div class="card">
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

<script lang="ts">
// Dependencias
import { defineComponent } from "vue"
import { EventosTabla } from "../domain/eventosTabla.domain"

// Componentes
import Listado from "@components/listado/Listado.vue"
import ButtonSubmits from "@components/ButtonSubmits.vue"
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"

export default defineComponent({
    props: {
        configuracionColumnas: {
            required: true,
            type: Array,
        },
        mixin: {
            type: Object as () => ContenedorMixin,
            required: true,
        },
        mostrarButtonSubmits: {
            type: Boolean,
            required: false,
            default: true,
        },
        mostrarTabFormulario: {
            type: Boolean,
            required: false,
            default: true,
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
    },
    components: {
        Listado,
        ButtonSubmits,
        SidebarLayout,
    },
    setup(props) {
        const mixin = props.mixin

        const { entidad, tabIndex, accion, listado } = mixin.useReferencias()
        const { guardar, consultar, editar, eliminar, reestablecer, listar } =
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

        listar()

        return {
            // mixin
            entidad,
            tabIndex,
            accion,
            listado,
            // operaciones
            columnas,
            reestablecer,
            consultar,
            editar,
            eliminar,
            guardar,
            tituloTabla: location.pathname
                .split("/")[2]
                ?.toString()
                .toLowerCase(),
        }
    },
})
</script>
