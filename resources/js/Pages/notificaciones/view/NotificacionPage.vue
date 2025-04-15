<template>
    <sidebar-layout>
        <h3 class="fs-5 mb-4 fw-bold">
            <i class="bi-bell me-2"></i>Notificaciones
        </h3>
        <p>Mensajes que provienen del formulario de contacto.</p>

        <div class="card">
            <botones-seleccionables
                v-model="filtrosNotificaciones"
            ></botones-seleccionables>
            <div class="card-body">
                <listado
                    :configuracion-columnas="columnas"
                    :elementos="listado"
                ></listado>
            </div>
        </div>
    </sidebar-layout>
</template>

<script lang="ts" src="./NotificacionPage.ts"></script>

<style lang="scss" scoped>
.card {
    transition: transform 0.1s ease;

    &.notification-animation:hover {
        transform: scale(1.01);
        border: 1px solid rgba(0, 0, 0, 0.4);
    }
}
.opciones-notificacion {
    position: absolute;
    top: 16px;
    right: 16px;
}
.tiempo-notificacion {
    position: absolute;
    bottom: 16px;
    right: 16px;
}

.opciones-notificacion button::after {
    display: none;
}
</style>
