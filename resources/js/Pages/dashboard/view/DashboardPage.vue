<template>
    <sidebar-layout>
        <h3 class="fs-5 mb-4 fw-bold">
            <i class="bi-house-fill me-2"></i>Dashboard
        </h3>

        <p>Hola {{ nombreUsuario }}, bienvenido.</p>

        <div class="">
            <h6 class="fw-bold py-3">Usuarios</h6>
            <div class="row row-cols-md-2 row-cols-1">
                <div class="col">
                    <div class="card card-body text-center mb-2">
                        <div>Usuarios registados</div>
                        <div class="fw-bold fs-4 text-success">
                            {{ usuarios }}
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-body text-center mb-2">
                        <div>Usuarios conectados</div>
                        <div class="fw-bold fs-4 text-success">
                            {{ usuariosConectados }}
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-body text-center mb-2">
                        <div>Usuarios conectados el dia de hoy</div>
                        <div class="fw-bold fs-4 text-success">
                            {{ usuariosConectadosDia }}
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-body text-center mb-2">
                        <div>Usuarios conectados en el mes</div>
                        <div class="fw-bold fs-4 text-success">
                            {{ usuariosConectadosMes }}
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold py-3">Facturación de planes</h6>
            <div class="row row-cols-md-2 row-cols-1">
                <div class="col">
                    <div class="card card-body text-center mb-2">
                        <div>Usuarios con facturación de planes (pagado)</div>
                        <div class="fw-bold fs-4 text-success">
                            {{ usuarioConPlanesPagados }}
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-body text-center mb-2">
                        <div>
                            Usuarios con facturación de planes (no pagado)
                        </div>
                        <div class="fw-bold fs-4 text-success">
                            {{ usuarioConPlanesNoPagados }}
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold py-3">Planes y servicios</h6>
            <div class="row row-cols-md-2 row-cols-1">
                <div class="col">
                    <div class="card card-body text-center mb-2">
                        <div>Servicios activos</div>
                        <div class="fw-bold fs-4 text-success">
                            {{ serviciosActivos }}
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card card-body text-center mb-2">
                        <div>Planes activos</div>
                        <div class="fw-bold fs-4 text-success">
                            {{ planesActivos }}
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold py-3">Por atender</h6>
            <div class="row row-cols-md-2 row-cols-1">
                <div class="col">
                    <div class="card card-body text-center mb-2">
                        <div>Pedidos de servicios por atender</div>
                        <div class="fw-bold fs-4 text-success">
                            {{ pedidos }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </sidebar-layout>
</template>

<script lang="ts" setup>
// Dependencias
import { useStore } from "vuex"
import { onMounted, ref, computed } from "vue"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"

const store = useStore()

defineProps([
    "usuarios",
    "serviciosActivos",
    "planesActivos",
    "pedidos",
    "usuariosConectados",
    "usuariosConectadosDia",
    "usuariosConectadosMes",
    "usuarioConPlanesPagados",
    "usuarioConPlanesNoPagados",
])

const toggleSidebar = () => store.dispatch("sidebar/toggleSidebar")
const notificaciones: any = ref([])

const nombreUsuario = computed(() => {
    const usuario = store.state.authentication.usuario
    return usuario ? `${usuario.name} ${usuario.apellidos ?? ""}` : ""
})

onMounted(() => {
    window.Echo.channel("channel-notificacion-contacto").listen(
        "NotificacionContactoEvent",
        (notificacion: any) => {
            console.log(notificacion)
            notificaciones.value.push(notificacion)
        }
    )
})
</script>
