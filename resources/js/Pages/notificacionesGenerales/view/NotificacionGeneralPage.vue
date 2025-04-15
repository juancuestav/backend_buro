<template>
    <sidebar-layout>
        <main>
            <h3 class="fs-5 mb-4 fw-bold">
                <i class="bi-bell me-2"></i>Notificaciones
            </h3>

            <div v-if="notificaciones.length">
                <div
                    v-for="notificacion in notificaciones"
                    class="card card-body mb-2"
                >
                    <p>{{ notificacion.mensaje }}</p>
                    <small class="text-end">
                        <b>{{ notificacion.fecha }}</b>
                    </small>
                </div>
            </div>
            <div v-else>Sin notificaciones</div>
        </main>
    </sidebar-layout>
</template>

<script src="./NotificacionGeneralPage.ts"></script>
