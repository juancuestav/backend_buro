<template>
    <tab-layout
        :configuracion-columnas="configuracionColumnas"
        :mixin="mixin"
        descripcion-pagina="Gestiona las solicitudes de mejoramiento de tus clientes."
        icono-pagina="bi-graph-up-arrow"
        :puede-consultar="false"
        :puede-eliminar="false"
    >
        <template #formulario>
            <form id="formulario" @submit.prevent>
                <h5 class="fw-bold mb-4">Datos del usuario</h5>
                <div class="row">
                    <!-- Cliente -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Cliente</label>
                        <input
                            v-model="mejoramiento.cliente"
                            type="text"
                            class="form-control"
                            readonly
                        />
                    </div>

                    <!-- Identificacion cliente -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label"
                            >Identificación del cliente</label
                        >
                        <input
                            v-model="mejoramiento.identificacion_cliente"
                            type="text"
                            class="form-control"
                            readonly
                        />
                    </div>

                    <!-- Puntaje actual -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Puntaje actual</label>
                        <input
                            v-model="mejoramiento.puntaje_actual"
                            type="text"
                            class="form-control"
                            readonly
                        />
                    </div>

                    <!-- Deudas vencidas -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Deudas vencidas</label>
                        <input
                            v-model="mejoramiento.deudas_vencidas"
                            type="text"
                            class="form-control"
                            readonly
                        />
                    </div>

                    <!-- Puntaje subir -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Puntaje a subir</label>
                        <input
                            v-model="mejoramiento.puntaje_subir"
                            type="text"
                            class="form-control"
                            readonly
                        />
                    </div>

                    <!-- Máximo a subir -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Máximo a subir</label>
                        <cleave
                            v-model="mejoramiento.maximo_subir"
                            :options="CONFIG_PUNTUACION"
                            class="form-control"
                            placeholder="Responder a cliente"
                        />
                    </div>

                    <!-- Observacion -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Observación</label>
                        <input
                            v-model="mejoramiento.observacion"
                            type="text"
                            class="form-control"
                            placeholder="Responder a cliente"
                        />
                    </div>

                    <!-- Estado -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Estado</label>
                        <select-input
                            v-model="mejoramiento.estado"
                            label="descripcion"
                            placeholder="Seleccione..."
                            :options="estadosMejoramiento"
                            :reduce="(item) => item.id"
                        >
                        </select-input>
                    </div>

                    <!-- Máximo a subir -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Fecha de la solicitud</label>
                        <input
                            v-model="mejoramiento.fecha"
                            type="text"
                            class="form-control"
                            readonly
                        />
                    </div>
                </div>
            </form>
        </template>
    </tab-layout>
</template>

<script src="./SolicitudMejoramientoPage.ts"></script>
