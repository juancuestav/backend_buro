<template>
    <sidebar-layout>
        <main>
            <h3 class="fs-5 mb-4 fw-bold">
                <i class="bi-graph-up-arrow me-2"></i>Solicitud de mejoramiento
            </h3>
            <p class="text-color">
                Puedes realizar un máximo de tres solicitudes por mes.
            </p>
            <!-- {{solicitudes}} -->
            <div class="card card-body mb-3">
                <div class="row mb-4">
                    <!-- Puntaje actual -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label"
                            >Puntaje actual (0 - 999)</label
                        >
                        <cleave
                            v-model="mejoramiento.puntaje_actual"
                            :options="CONFIG_PUNTUACION"
                            class="form-control"
                        />
                    </div>

                    <!-- Deudas vencidas -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Deudas vencidas</label>
                        <select-input
                            v-model="mejoramiento.deudas_vencidas"
                            label="descripcion"
                            placeholder="Seleccione..."
                            :options="estadosSI_NO"
                            :reduce="(item) => item.id"
                        >
                        </select-input>
                    </div>

                    <!-- Puntaje a subir -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Puntaje a subir</label>
                        <select-input
                            v-model="mejoramiento.puntaje_subir"
                            label="descripcion"
                            placeholder="Seleccione..."
                            :options="puntuaciones"
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

                <div class="text-center mb-3">
                    <small>
                        Has enviado
                        {{ solicitudesEnviadas }} solicitud(es) éste mes.
                    </small>
                </div>

                <button class="btn btn-success text-white" @click="enviar()">
                    <i class="bi-send me-2"></i>
                    Enviar solicitud
                </button>
            </div>

            <div class="mb-3 fw-bold">
                <i class="bi-check-circle-fill me-2 text-success"></i> Estado de
                su solicitud
            </div>

            <card-mejoramiento
                v-if="solicitudData"
                :mejoramiento="solicitudData"
            ></card-mejoramiento>
            <div v-else>Aún no has enviado ninguna solicitud</div>
        </main>
    </sidebar-layout>
</template>

<script src="./MejoramientoPage.ts"></script>
