<template>
    <column-layout
        :configuracion-columnas="configuracionColumnas"
        :mixin="mixin"
        descripcion-pagina="Administra los roles del sistema y asígnales permisos."
        icono-pagina="bi-sliders"
    >
        <template #formulario>
            <form id="formulario" @submit.prevent>
                <div class="d-flex flex-column">
                    <!-- Nombre del rol -->
                    <div class="mb-4">
                        <label class="form-label">Nombre del rol</label>
                        <input
                            v-model="rol.name"
                            class="form-control"
                            type="text"
                        />
                    </div>
                </div>
            </form>
        </template>
    </column-layout>
</template>

<script src="./RolPage.ts"></script>
