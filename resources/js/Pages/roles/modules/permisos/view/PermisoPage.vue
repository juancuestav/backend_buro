<template>
    <sidebar-layout>
        <div class="card">
            <div class="card-header">
                <i class="bi-sliders me-2"></i>Permisos
            </div>

            <div class="card-body p-4">
                <div v-for="modulo in listado_permisos" :key="modulo.modulo">
                    <h6 class="fw-bold mb-4">
                        {{
                            modulo.modulo?.charAt(0).toUpperCase() +
                            modulo.modulo
                                ?.slice(1)
                                .toLowerCase()
                                .replaceAll("_", " ")
                        }}
                    </h6>
                    <div class="row row-cols-md-4 row-cols-2 mb-4">
                        <div
                            v-for="permiso in modulo.permisos"
                            :key="permiso.permiso"
                            class="col"
                        >
                            <b></b>
                            <div class="form-check form-switch">
                                <input
                                    :checked="permiso.activo"
                                    class="form-check-input"
                                    type="checkbox"
                                    :id="permiso.permiso"
                                    @click="gestionarPermiso(permiso.permiso)"
                                />
                                <label
                                    class="form-check-label"
                                    :for="permiso.permiso"
                                >
                                    {{
                                        permiso.descripcion
                                            ?.charAt(0)
                                            .toUpperCase() +
                                        permiso.descripcion
                                            ?.slice(1)
                                            .toLowerCase()
                                    }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div
                        class="col-12 d-grid d-md-flex justify-content-md-end gap-2"
                    >
                        <button
                            class="btn btn-primary block"
                            @click="guardarConfiguracion()"
                        >
                            <i class="bi-save me-2"></i>
                            Actualizar permisos
                        </button>
                        <Link
                            href="/admin/roles/page"
                            type="button"
                            class="btn btn-light"
                        >
                            Volver a roles
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </sidebar-layout>
</template>

<script src="./PermisoPage.ts"></script>

<style scoped>
.permiso {
    text-transform: capitalize;
}
</style>
