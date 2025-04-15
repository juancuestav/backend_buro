<template>
    <sidebar-layout>
        <form class="card" @submit.prevent>
            <div class="card-header"><i class="bi-person-fill"></i> Perfil</div>
            <div class="card-body">
                <div class="row">
                    <!-- Nombre -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Nombre</label>
                        <input
                            v-model="perfil.name"
                            v-focus
                            type="text"
                            class="form-control"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Apellidos -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Apellidos</label>
                        <input
                            v-model="perfil.apellidos"
                            type="text"
                            class="form-control"
                            placeholder="Opcional"
                        />
                    </div>

                    <!-- Celular -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Celular</label>
                        <input
                            v-model="perfil.celular"
                            type="text"
                            class="form-control"
                            placeholder="Opcional"
                        />
                    </div>

                    <!-- Correo -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Correo</label>
                        <input
                            v-model="perfil.email"
                            type="email"
                            class="form-control"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Tipo de identificacion -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Tipo de identificación</label>
                        <select-input
                            v-model="perfil.tipo_identificacion"
                            label="descripcion"
                            placeholder="Seleccione..."
                            :options="tipos_identificaciones"
                            :reduce="(item) => item.id"
                        >
                        </select-input>
                    </div>

                    <!-- Indentificacion -->
                    <div class="col-md-3 col-lg-4 mb-4">
                        <label class="form-label">Identificación</label>
                        <input
                            v-model="perfil.identificacion"
                            type="text"
                            class="form-control"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <div
                        class="col-12 d-grid d-md-flex justify-content-md-end gap-2"
                    >
                        <button
                            class="btn btn-primary block"
                            @click="actualizar()"
                        >
                            <i class="bi-save me-2"></i>
                            Actualizar perfil
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </sidebar-layout>
</template>

<script lang="ts" src="./PerfilPage.ts"></script>
