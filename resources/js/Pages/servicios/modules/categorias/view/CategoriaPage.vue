<template>
    <column-layout
        :configuracion-columnas="configuracionColumnas"
        :mixin="mixin"
        descripcion-pagina="Gestiona las categorías y asígnalas a tus servicios."
        icono-pagina="bi-collection"
    >
        <template #formulario>
            <form id="formulario" @submit.prevent>
                <div class="d-flex flex-column">
                    <!-- Precio del envio -->
                    <div class="mb-4">
                        <label class="form-label">Nombre de la categoría</label>
                        <input
                            v-model="categoria.nombre"
                            v-focus
                            :disabled="disabled"
                            class="form-control"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- Orden -->
                    <div class="mb-4">
                        <label class="form-label">Orden</label>
                        <input
                            v-model="categoria.orden"
                            :disabled="disabled"
                            class="form-control"
                            type="number"
                            min="0"
                            placeholder="Obligatorio"
                        />
                    </div>
                </div>
            </form>
        </template>
    </column-layout>
</template>

<script src="./CategoriaPage.ts"></script>
