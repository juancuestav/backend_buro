<template>
    <sidebar-layout>
        <div class="card">
            <div class="card-header">
                <i class="bi-gear me-2"></i>Configuración del sistema
            </div>
            <div class="card-body">

                
                <!-- Precios -->
                <div class="mb-4">
                    <div class="fw-bold mb-4">
                        <i class="bi-tags me-2"></i>Precios
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <label class="form-label">Porcentaje IVA</label>
                            <cleave
                                v-model="configuracion.porcentaje_iva"
                                :options="CONFIG_PORCENTAJE"
                                class="form-control"
                                placeholder="Obligatorio"
                            />
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <!-- Redes sociales -->
                    <div class="fw-bold mb-4">
                        <i class="bi-chat me-2"></i>Redes sociales
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <label class="form-label">Whatsapp</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-whatsapp"></i>
                                </div>
                                <cleave
                                    v-model="configuracion.whatsapp"
                                    :options="CONFIG_CELULAR"
                                    class="form-control"
                                    placeholder="Obligatorio"
                                />
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-4">
                            <label class="form-label">Facebook</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-facebook"></i>
                                </div>
                                <input
                                    v-model="configuracion.facebook"
                                    type="text"
                                    class="form-control"
                                    placeholder="https://"
                                />
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-4">
                            <label class="form-label">Instagram</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-instagram"></i>
                                </div>
                                <input
                                    v-model="configuracion.instagram"
                                    type="text"
                                    class="form-control"
                                    placeholder="https://"
                                />
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-4">
                            <label class="form-label">Twitter</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-twitter"></i>
                                </div>
                                <input
                                    v-model="configuracion.twitter"
                                    type="text"
                                    class="form-control"
                                    placeholder="https://"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <!-- Pagos -->
                    <div class="fw-bold mb-4">
                        <i class="bi-credit-card me-2"></i>Pagos
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-4">
                            <label class="form-label"
                                >Pagos en efectivo (*)</label
                            >
                            <select-input
                                v-model="configuracion.admite_pago_efectivo"
                                label="descripcion"
                                placeholder="Seleccione..."
                                :options="estados"
                                :reduce="(item) => item.id"
                            >
                            </select-input>
                        </div>

                        <div class="col-md-6 col-lg-4 mb-4">
                            <label class="form-label"
                                >Pagos con tarjeta (*)</label
                            >
                            <select-input
                                v-model="configuracion.admite_pago_tarjeta"
                                label="descripcion"
                                placeholder="Seleccione..."
                                :options="estados"
                                :reduce="(item) => item.id"
                            >
                            </select-input>
                        </div>

                        <div
                            v-if="
                                configuracion.admite_pago_tarjeta === 'ACTIVO'
                            "
                            class="col-md-6 col-lg-4 mb-4"
                        >
                            <label class="form-label">
                                URL pago con tarjeta</label
                            >
                            <input
                                v-model="configuracion.url_pago_tarjeta"
                                type="text"
                                class="form-control"
                                placeholder="https://"
                            />
                        </div>

                        <div class="col-md-6 col-lg-4 mb-4">
                            <label class="form-label">
                                Transferencia / Depósito bancario (*)</label
                            >
                            <select-input
                                v-model="configuracion.admite_deposito_bancario"
                                label="descripcion"
                                placeholder="Seleccione..."
                                :options="estados"
                                :reduce="(item) => item.id"
                            >
                            </select-input>
                        </div>

                        <div
                            v-if="
                                configuracion.admite_deposito_bancario ===
                                'ACTIVO'
                            "
                            class="col-md-6 col-lg-4 mb-4"
                        >
                            <label class="form-label">
                                No. cuenta para transferencias o
                                depósitos</label
                            >
                            <input
                                v-model="configuracion.numero_cuenta"
                                type="text"
                                class="form-control"
                                placeholder="Obligatorio"
                            />
                        </div>

                        <div
                            v-if="
                                configuracion.admite_deposito_bancario ===
                                'ACTIVO'
                            "
                            class="col-md-6 col-lg-4 mb-4"
                        >
                            <label class="form-label">
                                Entidad financiera</label
                            >
                            <input
                                v-model="configuracion.entidad_financiera"
                                type="text"
                                class="form-control"
                                placeholder="Obligatorio"
                            />
                        </div>

                        <div
                            v-if="
                                configuracion.admite_deposito_bancario ===
                                'ACTIVO'
                            "
                            class="col-md-6 col-lg-4 mb-4"
                        >
                            <label class="form-label">
                                Propietario de cuenta</label
                            >
                            <input
                                v-model="configuracion.propietario_cuenta"
                                type="text"
                                class="form-control"
                                placeholder="Obligatorio"
                            />
                        </div>

                        <div
                            v-if="
                                configuracion.admite_deposito_bancario ===
                                'ACTIVO'
                            "
                            class="col-md-6 col-lg-4 mb-4"
                        >
                            <label class="form-label">
                                Identificación del propietario de la
                                cuenta</label
                            >
                            <input
                                v-model="
                                    configuracion.identificacion_propietario_cuenta
                                "
                                type="text"
                                class="form-control"
                                placeholder="Obligatorio"
                            />
                        </div>

                        <div
                            v-if="
                                configuracion.admite_deposito_bancario ===
                                'ACTIVO'
                            "
                            class="col-md-6 col-lg-4 mb-4"
                        >
                            <label class="form-label">
                                Número de contacto</label
                            >
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-telephone"></i>
                                </div>
                                <cleave
                                    v-model="configuracion.numero_contacto"
                                    :options="CONFIG_CELULAR"
                                    class="form-control"
                                    placeholder="Obligatorio"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div
                        class="col-12 d-grid d-md-flex justify-content-md-end gap-2"
                    >
                        <button class="btn btn-primary block" @click="editar">
                            <i class="bi-save me-2"></i>
                            Guardar cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </sidebar-layout>
</template>

<script src="./ConfiguracionPage.ts"></script>
