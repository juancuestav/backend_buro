<template>
    <column-layout
        :configuracion-columnas="configuracionColumnas"
        :mixin="mixin"
        descripcion-pagina="Administra las entidades financieras con las que trabajas para asignarlas en el registro de depósitos y transferencias y, en los reportes para tus clientes."
        icono-pagina="bi-building"
    >
        <template #formulario>
            <form id="formulario" @submit.prevent>
                <div class="d-flex flex-column">
                    <!-- Nombre -->
                    <div class="mb-4">
                        <label class="form-label">Nombre</label>
                        <input
                            v-model="entidadFinanciera.nombre"
                            v-focus
                            :disabled="disabled"
                            type="text"
                            class="form-control"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Tipo -->
                    <div class="mb-4">
                        <label class="form-label">Tipo</label>
                        <select-input
                            v-model="entidadFinanciera.tipo"
                            label="descripcion"
                            placeholder="Seleccione..."
                            :disabled="disabled"
                            :clearable="true"
                            :options="tiposEntidadesFinancieras"
                            :reduce="(item) => item.id"
                        >
                        </select-input>
                    </div>
                </div>
            </form>
        </template>
    </column-layout>
</template>

<script src="./EntidadFinancieraPage.ts"></script>
