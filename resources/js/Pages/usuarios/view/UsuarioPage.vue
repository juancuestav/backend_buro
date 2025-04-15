<template>
    <tab-layout
        :configuracion-columnas="configuracionColumnas"
        :mixin="mixin"
        descripcion-pagina="Administra la información de tus usuarios y asígnales roles."
        icono-pagina="bi-people"
    >
        <template #formulario>
            <form id="formulario" @submit.prevent>
                <h5 class="fw-bold mb-4">Datos del usuario</h5>
                <div class="row mb-4">
                    <!-- Nombre -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Nombre</label>
                        <input
                            v-model="usuario.name"
                            type="text"
                            class="form-control"
                            :disabled="disabled"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Apellidos -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Apellidos</label>
                        <input
                            v-model="usuario.apellidos"
                            type="text"
                            class="form-control"
                            :disabled="disabled"
                            placeholder="Opcional"
                        />
                    </div>

                    <!-- Edad -->
                    <div
                        v-if="usuario.rol.includes(rolesPredeterminados.CLIENTE)"
                        class="col-md-3 col-lg-4 mb-4"
                    >
                        <label class="form-label">Edad</label>
                        <input
                            v-model="usuario.edad"
                            type="number"
                            min="0"
                            class="form-control"
                            :disabled="disabled"
                            placeholder="Opcional"
                        />
                    </div>

                    <!-- Direccion -->
                    <div
                        v-if="usuario.rol.includes(rolesPredeterminados.CLIENTE)"
                        class="col-md-3 col-lg-4 mb-4"
                    >
                        <label class="form-label">Dirección</label>
                        <input
                            v-model="usuario.direccion"
                            type="text"
                            class="form-control"
                            :disabled="disabled"
                            placeholder="Opcional"
                        />
                    </div>

                    <!-- Celular -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Celular</label>
                        <cleave
                            v-model="usuario.celular"
                            :options="CONFIG_CELULAR"
                            class="form-control"
                            :disabled="disabled"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Correo -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Correo</label>
                        <input
                            v-model="usuario.email"
                            type="email"
                            class="form-control"
                            :disabled="disabled"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Tipo de identificacion -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Tipo de identificación</label>
                        <select-input
                            v-model="usuario.tipo_identificacion"
                            label="descripcion"
                            placeholder="Seleccione..."
                            :options="tipos_identificaciones"
                            :reduce="(item) => item.id"
                            :disabled="disabled"
                        >
                        </select-input>
                    </div>

                    <!-- Indentificacion -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Identificación</label>
                        <input
                            v-model="usuario.identificacion"
                            type="text"
                            class="form-control"
                            :disabled="disabled"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Contraseña -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label v-if="accion === 'MODIFICAR'" class="form-label"
                            >Nueva contraseña</label
                        >
                        <label v-else class="form-label">Contraseña</label>
                        <input
                            v-model="usuario.password"
                            type="password"
                            class="form-control"
                            :disabled="disabled"
                            :placeholder="
                                accion === 'NUEVO' ? 'Obligatorio' : 'Opcional'
                            "
                        />
                    </div>

                    <!-- Confirmar contraseña -->
                    <div
                        v-show="accion !== 'ELIMINAR' || accion !== 'CONSULTAR'"
                        class="col-md-3 col-lg-4 mb-4"
                    >
                        <label class="form-label">Confirmar contraseña</label>
                        <input
                            v-model="usuario.password_confirmation"
                            type="password"
                            class="form-control"
                            :disabled="disabled"
                            :placeholder="
                                accion === 'NUEVO' ? 'Obligatorio' : 'Opcional'
                            "
                        />
                    </div>

                    <!-- Rol -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Rol</label>
                        <select-input
                            v-model="usuario.rol"
                            label="descripcion"
                            placeholder="Seleccione..."
                            :options="roles"
                            :reduce="(item) => item.id"
                            :multiple="true"
                            :disabled="disabled"
                        >
                        </select-input>
                    </div>

                    <!-- Puede recibir notificaciones -->
                    <div
                        v-if="
                            usuario.rol.includes(rolesPredeterminados.ADMINISTRADOR) ||
                            usuario.rol.includes(rolesPredeterminados.EMPLEADO)
                        "
                        class="col-md-6 col-lg-4 mb-4"
                    >
                        <div class="form-check form-switch">
                            <br />
                            <input
                                v-model="usuario.puede_recibir_notificaciones"
                                :disabled="disabled"
                                class="form-check-input"
                                type="checkbox"
                                id="puede_recibir_notificaciones"
                            />
                            <label
                                class="form-check-label"
                                for="puede_recibir_notificaciones"
                            >
                                Puede recibir notificaciones
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </template>
    </tab-layout>
</template>

<script src="./UsuarioPage.ts"></script>
