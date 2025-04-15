<template>
    <nav
        class="navbar-light sticky-top d-flex align-items-center justify-content-between px-3 pt-2 pb-4 custom-navbar"
        :style="{ 'margin-left': 'calc(' + marginLeftPage + ')' }"
    >
        <span class="cursor-pointer" @click="toggleSidebar">
            <img src="/img/burger.svg" height="26" />
        </span>

        <ul class="mb-0 d-flex align-items-center">
            <!-- Dropdown notificaciones -->
            <li v-if="mostrarNotificaciones" class="nav-item dropdown me-2">
                <button
                    type="button"
                    class="bg-transparent border-0 nav-link position-relative"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    data-bs-auto-close="false"
                >
                    <i class="bi-bell"></i>
                    <span
                        v-if="notificaciones.length"
                        style="padding: 5px"
                        class="position-absolute top-75 start-75 translate-middle bg-success rounded-circle badge"
                    >
                        {{ notificaciones.length }}
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </button>

                <!-- Dropdown notificaciones body -->
                <div
                    class="dropdown-menu dropdown-menu-end alto-notificaciones"
                >
                    <div v-if="notificaciones.length">
                        <li>
                            <h6 class="dropdown-header">Notificaciones</h6>
                        </li>

                        <div
                            v-for="(notificacion, index) in notificaciones"
                            :key="index"
                            class="btn-group dropstart w-100"
                        >
                            <!-- Boton notificacion -->
                            <button
                                class="bg-white border-0 px-4 py-2 w-100 text-end notificacion"
                                @click="
                                    () => {
                                        activarChat(notificacion)
                                        marcarLeido(notificacion.id)
                                    }
                                "
                            >
                                <div class="text-nowrap">
                                    <span class="fw-bold"
                                        >{{
                                            notificacion.data.nombre +
                                            " " +
                                            notificacion.data.apellidos
                                        }} </span
                                    >{{ " ha enviado un mensaje." }}
                                </div>
                                <div class="text-end mb-2">
                                    <timeago :datetime="notificacion.fecha" />
                                </div>
                            </button>

                            <!-- Dropdown opciones notificacion -->
                            <button
                                type="button"
                                class="bg-white border-0 dropdown-toggle dropdown-toggle-split opciones-notificacion"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <i class="bi-three-dots-vertical"></i>
                            </button>

                            <!-- Dropdown opciones notificacion body -->
                            <ul
                                class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="dropdownOpcionesNotificacion"
                            >
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        @click="marcarLeido(notificacion.id)"
                                        >Marcar como leído
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div
                        v-else
                        class="d-flex flex-column align-items-center text-color"
                    >
                        <i class="bi-emoji-frown"></i>
                        <span>No tienes notificaciones</span>
                    </div>

                    <div class="dropdown-divider"></div>
                    <Link
                        :href="rutaNotificaciones"
                        class="dropdown-item dropdown-footer text-center"
                        >Ver panel de notificaciones</Link
                    >
                </div>
            </li>

            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    {{ nombreUsuario }}
                </a>
                <!-- Dropdown content -->
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDarkDropdownMenuLink"
                >
                    <li>
                        <button class="dropdown-item" @click="logout">
                            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                        </button>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script lang="ts">
// Dependencias
import { computed, defineComponent, ref, onMounted } from "vue"
import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"
import { useStore } from "vuex"
import axios from "axios"
import can from "@/mixins/Permissions"

// Components
import { Link } from "@inertiajs/inertia-vue3"
import useSidebar from "../theSidebar/composables/useSidebar"
import { Notificacion } from "@/Pages/notificaciones/domain/Notificacion.domain"

export default defineComponent({
    components: { Link },
    setup() {
        const store = useStore()
        const { toggleSidebar, marginLeftPage } = useSidebar()

        const rutaNotificaciones =
            getEndpoint(endpoints.notificaciones) + "page"

        async function logout() {
            const element: any = document?.querySelector(
                'meta[name="csrf-token"]'
            )

            const _token = element.content
            const data = { _token }

            const response = await axios.post(
                getEndpoint(endpoints.logout),
                data
            )
            if (response.status === 204) {
                window.location.replace("/")
            }
        }

        const nombreUsuario = computed(() => {
            const usuario = store.state.authentication.usuario
            return usuario ? `${usuario.name} ${usuario.apellidos ?? ""}` : ""
        })

        const notificaciones: any = ref([])

        async function obtenerNotificaciones() {
            const ruta = getEndpoint(endpoints.notificaciones_contacto)
            const response = await axios.get(ruta)
            const results = response.data.results.map((notificacion: any) => {
                return {
                    id: notificacion.id,
                    data: notificacion.data,
                    fecha: notificacion.created_at,
                }
            })

            notificaciones.value.push(...results)
        }

        async function marcarLeido(id: string) {
            const response = await axios.put(
                getEndpoint(endpoints.notificaciones_contacto) + id
            )
            console.log(response.data.mensaje)

            notificaciones.value.splice(indiceNotificacion(id), 1)
        }

        const indiceNotificacion = (id: string) =>
            notificaciones.value.findIndex(
                (notificacion: Notificacion) => notificacion.id === id
            )

        function activarChat(notificacion: any) {
            store.dispatch("chat/mostrarChat")
            store.commit("chat/SET_NOTIFICACION", notificacion)
        }

        const mostrarNotificaciones = can("puede.recibir.notificaciones")
        if (mostrarNotificaciones) obtenerNotificaciones()

        onMounted(() => {
            window.Echo.channel("channel-notificacion-contacto").listen(
                "NotificacionContactoEvent",
                (data: any) => {
                    notificaciones.value = []
                    obtenerNotificaciones()
                }
            )
        })

        return {
            nombreUsuario,
            logout,
            rutaNotificaciones,
            notificaciones,
            mostrarNotificaciones,
            marcarLeido,
            toggleSidebar,
            marginLeftPage,
            activarChat,
        }
    },
})
</script>

<style lang="scss" scoped>
.alto-notificaciones {
    max-height: 400px;

    overflow-y: scroll;
    // height: 400px;

    // Custom scrollbar
    &::-webkit-scrollbar {
        width: 10px;
        background-color: #f8fafc;
    }

    &::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 50px;
    }
}

.nav-item {
    list-style: none;
}

.custom-navbar {
    z-index: 50;
    // background-color: #f2f2f2;
    background: linear-gradient(
        to bottom,
        rgba(248, 248, 250, 1) 60%,
        rgba(0, 0, 0, 0) 80%
    );
}

.notificacion:hover {
    background-color: #f7f7f7 !important;
}

button.opciones-notificacion::before {
    display: none;
}
</style>
