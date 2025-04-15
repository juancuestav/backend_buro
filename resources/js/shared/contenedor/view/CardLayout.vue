<template>
    <sidebar-layout>
        <slot name="modales" />

        <!-- Modal: nuevo negocio-->
        <div ref="refFormularioModal" class="modal fade">
            <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ tituloModal }}</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                        ></button>
                    </div>
                    <!-- Contenido del modal -->
                    <div class="modal-body">
                        <div class="card p-4">
                            <slot name="formulario" />
                            <button-submits
                                :accion="accion"
                                @cancelar="ocultar()"
                                @guardar="guardar(entidad)"
                                @editar="editar(entidad)"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido principal: cards -->
        <h3 class="fs-5 mb-4 fw-bold">
            <i class="bi-badge-ad me-2"></i>{{ tituloPanel }}
        </h3>
        <p class="text-color">
            Coloca imágenes con tus promociones para que se muestren en la
            pantalla de inicio.
        </p>

        <div class="row row-cols-1 row-cols-md-3 my-4">
            <div class="col">
                <div class="card card-image">
                    <img
                        :src="imagenAgregar"
                        width="160"
                        height="160"
                        class="card-img-top p-5"
                        style="object-fit: contain"
                        alt="Logo del negocio"
                    />
                    <div class="card-body text-center">
                        <a
                            class="card-text stretched-link text-decoration-none fw-bold"
                            @click="mostrar()"
                        >
                            {{ textoBotonCrearModal }}</a
                        >
                    </div>
                </div>
            </div>

            <div class="col" v-for="item in listado" :key="item.id">
                <card-image
                    :image-url="item.imagen"
                    title=""
                    :subtitle="item.titulo"
                    class="card-image"
                    :permitir-custom-action="permitirCustomAction"
                    :permitir-custom-action2="permitirCustomAction2"
                    @click-event="cardSeleccionado(item.id)"
                    @eliminar="eliminarCard(item.id)"
                    @custom-action="runCustomAction(item.id)"
                    @custom-action2="runCustomAction2(item.id)"
                ></card-image>
            </div>
        </div>
    </sidebar-layout>
</template>

<script lang="ts">
// Dependencias
import { defineComponent, onMounted, ref, UnwrapRef } from "vue"
import { acciones } from "@config/utils.config"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import CardImage from "@components/CardImage.vue"
import ButtonSubmits from "@components/ButtonSubmits.vue"
import Modal from "bootstrap/js/src/modal.js"

// Logica y controladores
import { ContenedorMixin } from "../../contenedorMixin/ContenedorMixin"

export default defineComponent({
    components: {
        SidebarLayout,
        ButtonSubmits,
        CardImage,
    },
    props: {
        mixin: {
            type: Object as () => ContenedorMixin,
            required: true,
        },
        tituloPanel: {
            type: String,
            required: true,
        },
        tituloModal: {
            type: String,
            required: false,
            default: "Modal",
        },
        textoBotonCrearModal: {
            type: String,
            required: false,
            default: "Crear",
        },
        cbSeleccionarCard: {
            type: Function,
            required: false,
        },
        permitirCustomAction: {
            type: Boolean,
            required: false,
        },
        customAction: {
            type: Function,
            required: false,
        },
        permitirCustomAction2: {
            type: Boolean,
            required: false,
        },
        customAction2: {
            type: Function,
            required: false,
        },
    },

    setup(props) {
        const refFormularioModal = ref()
        let modal: UnwrapRef<any>

        onMounted(() => (modal = new Modal(refFormularioModal.value)))

        // mixin
        const mixin = props.mixin
        const { listar, guardar, editar, consultar, eliminar, reestablecer } =
            mixin.useComportamiento()

        const { entidad, listado, accion } = mixin.useReferencias()

        listar()

        // Mostra / ocultar modal
        const mostrar = () => {
            reestablecer()
            modal.show()
        }

        const ocultar = () => {
            reestablecer()
            modal.hide()
        }

        const imagenAgregar = window.location.origin + "/img/add_alt.svg"

        const cardSeleccionado = async (id: number) => {
            await consultar({ id })
            mostrar()
            accion.value = acciones.modificar
        }

        const eliminarCard = async (id: number) => {
            await consultar({ id })
            eliminar()
        }

        const runCustomAction = (id: number) => {
            if (props.customAction) {
                props.customAction(id)
            }
        }

        const runCustomAction2 = (id: number) => {
            if (props.customAction2) {
                props.customAction2(id)
            }
        }

        return {
            refFormularioModal,
            // Referencias del mixin
            entidad,
            listado,
            accion,
            // Comportamiento del mixin
            guardar,
            editar,
            eliminar,
            // Propiedades del componente
            ocultar,
            mostrar,
            modal,
            imagenAgregar,
            cardSeleccionado,
            eliminarCard,
            runCustomAction,
            runCustomAction2,
        }
    },
})
</script>

<style lang="scss" scoped>
.card-image {
    transition: all 0.2s ease;
    overflow: hidden;
    cursor: pointer;

    &:hover {
        transform: scale(1.02);
    }

    &:active {
        transform: scale(1.04);
    }
}

a {
    cursor: pointer;
}
</style>
