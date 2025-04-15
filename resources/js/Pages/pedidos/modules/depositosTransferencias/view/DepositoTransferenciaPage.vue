<template>
    <sidebar-layout>
        <div class="card mb-2">
            <div class="card-body px-3 py-2">
                <i class="bi-plus-circle-dotted me-2"></i>Registrar depósito o
                transferencia
            </div>
        </div>

        <div class="row">
            <!-- Formulario -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="bi-plus-lg me-2"></i>Formulario
                    </div>

                    <div class="card-body p-4">
                        <form id="formulario" @submit.prevent>
                            <div class="row mb-4">
                                <!-- Cuenta banco -->
                                <div class="col-md-3 col-lg-4 mb-4">
                                    <label class="form-label">Cuenta</label>
                                    <select-input
                                        v-model="entidad.cuenta"
                                        label="descripcion"
                                        placeholder="Seleccione..."
                                        :disabled="disabled"
                                        :options="entidades_financieras"
                                        :reduce="(item) => item.id"
                                    ></select-input>
                                </div>

                                <!-- Motivo -->
                                <div class="col-md-3 col-lg-4 mb-4">
                                    <label class="form-label">Motivo</label>
                                    <input
                                        v-model="entidad.motivo"
                                        type="text"
                                        class="form-control"
                                        placeholder="Obligatorio"
                                        :disabled="disabled"
                                    />
                                </div>

                                <!-- Monto -->
                                <div class="col-md-3 col-lg-4 mb-4">
                                    <label class="form-label">Monto</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                            >US$</span
                                        >
                                        <cleave
                                            v-model="entidad.monto"
                                            :options="CONFIG_DECIMALES"
                                            class="form-control"
                                            placeholder="Obligatorio"
                                            disabled
                                        />
                                    </div>
                                </div>

                                <!-- Comprobante -->
                                <div class="col-md-3 col-lg-4 mb-4">
                                    <label class="form-label"
                                        >No. Comprobante</label
                                    >
                                    <input
                                        v-model="entidad.comprobante"
                                        type="text"
                                        class="form-control"
                                        placeholder="Obligatorio"
                                        :disabled="disabled"
                                    />
                                </div>

                                <!-- Fecha transaccion -->
                                <div class="col-md-3 col-lg-4 mb-4">
                                    <label class="form-label"
                                        >Fecha de la transacción</label
                                    >
                                    <input
                                        v-model="entidad.fecha_transaccion"
                                        type="date"
                                        class="form-control"
                                        placeholder="Obligatorio"
                                        disabled
                                    />
                                </div>

                                <!-- Es deposito -->
                                <div class="col-md-3 col-lg-4 mb-4">
                                    <div class="form-check form-switch">
                                        <br />
                                        <input
                                            v-model="entidad.es_deposito"
                                            class="form-check-input"
                                            type="checkbox"
                                            id="es_deposito"
                                            :disabled="disabled"
                                        />
                                        <label
                                            class="form-check-label"
                                            for="es_deposito"
                                        >
                                            Es depósito
                                        </label>
                                    </div>
                                </div>

                                <div
                                    v-show="!entidad.es_deposito"
                                    class="col-md-3 col-lg-4 mb-4"
                                >
                                    <label class="form-label"
                                        >Tipo de transacción</label
                                    >
                                    <select-input
                                        v-model="entidad.tipo_transferencia"
                                        label="descripcion"
                                        placeholder="Seleccione..."
                                        :disabled="disabled"
                                        :options="tiposTransferencias"
                                        :reduce="(item) => item.id"
                                    >
                                    </select-input>
                                </div>

                                <!-- Imagen -->
                                <div class="col-md-3 col-lg-4 mb-4">
                                    <label class="form-label"
                                        >Imagen del depósito</label
                                    >
                                    <selector-imagen
                                        :archivo="entidad.imagen"
                                        @change="setBase64($event)"
                                        :disabled="disabled"
                                    ></selector-imagen>
                                    <small
                                        v-if="!!imagenEntidad"
                                        class="mt-1 border border-1 rounded-3 text-center bg-light d-block"
                                    >
                                        <a
                                            class="text-decoration-none"
                                            :href="imagenEntidad"
                                            target="_blank"
                                            >Ver en pantalla completa</a
                                        >
                                    </small>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div
                                class="col d-grid gap-2 d-md-flex justify-content-md-end"
                            >
                                <button
                                    form="formulario"
                                    v-if="!disabled"
                                    class="btn btn-primary"
                                    type="submit"
                                    @click="guardarPedido()"
                                >
                                    <i class="bi-save me-2"></i>Registrar pago
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-light"
                                    @click="consultarPedido()"
                                >
                                    Volver
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </sidebar-layout>
</template>

<script src="./DepositoTransferenciaPage.ts"></script>
