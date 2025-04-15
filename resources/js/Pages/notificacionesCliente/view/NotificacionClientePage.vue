<template>
    <sidebar-layout>
        <main>
            <h3 class="fs-5 mb-4 fw-bold">
                <i class="bi-bell me-2"></i>Notificaciones para los clientes
            </h3>
            <p class="text-color">Envia mensajes a tus clientes.</p>

            <div class="card card-body mb-3">
                <label class="form-label">Mensaje</label>
                <textarea
                    v-model="mensaje"
                    class="form-control mb-3"
                    placeholder="Escriba su mensaje aquí"
                ></textarea>
                <button class="btn btn-success text-white" @click="enviar()">
                    <i class="bi-send me-2"></i>
                    Enviar a todos los clientes
                </button>
            </div>

            <div class="row">
                <!-- Listado -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="bi-list me-2"></i>Listado de mensajes
                            enviados
                        </div>

                        <div class="card-body">
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasWithEvents
                                "
                                :elementos="listado"
                                :permitirExportar="false"
                                :permitirOcultarColumnas="false"
                            ></listado>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </sidebar-layout>
</template>

<script src="./NotificacionClientePage.ts"></script>
