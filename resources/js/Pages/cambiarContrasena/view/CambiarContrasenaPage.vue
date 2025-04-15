<template>
    <sidebar-layout>
        <div class="card">
            <div class="card-header title-color">
                <i class="bi-lock-fill"></i> Cambiar contraseña
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Contraseña actual -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Contraseña actual</label>
                        <input
                            v-model="cambiarContrasena.current_password"
                            v-focus
                            type="password"
                            class="form-control"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Contraseña -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Nueva contraseña</label>
                        <input
                            v-model="cambiarContrasena.password"
                            type="password"
                            class="form-control"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Confirmar contraseña -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label"
                            >Confirmar nueva contraseña</label
                        >
                        <input
                            v-model="cambiarContrasena.password_confirmation"
                            type="password"
                            class="form-control"
                            placeholder="Obligatorio"
                        />
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-grid d-md-flex justify-content-md-end">
                        <button class="btn btn-primary block" @click="guardar">
                            <i class="bi-save me-2"></i>
                            Cambiar contraseña
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </sidebar-layout>
</template>

<script src="./CambiarContrasenaPage.ts"></script>
