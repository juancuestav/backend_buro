<template>
    <div class="card card-body mb-3">
        <div class="row">
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

            <!-- Deudas vencidas -->
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
                <input
                    v-model="mejoramiento.maximo_subir"
                    type="text"
                    class="form-control"
                    readonly
                />
            </div>

            <!-- Observacion -->
            <div class="col-md-3 col-lg-4 mb-4">
                <label class="form-label">Observación</label>
                <input
                    v-model="mejoramiento.observacion"
                    type="text"
                    class="form-control"
                    readonly
                />
            </div>

            <!-- Estado -->
            <div class="col-md-3 col-lg-4 mb-4">
                <label class="form-label">Estado</label>
                <input
                    v-model="mejoramiento.estado"
                    type="text"
                    class="form-control"
                    readonly
                />
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
    </div>
</template>

<script lang="ts" setup>
defineProps(["mejoramiento"])
</script>
