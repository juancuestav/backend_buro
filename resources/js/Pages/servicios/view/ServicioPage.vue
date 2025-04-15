<template>
    <tab-layout
        :configuracion-columnas="configuracionColumnas"
        :mixin="mixin"
        descripcion-pagina="Crea y gestiona tus planes y servicios."
        icono-pagina="bi-person-workspace"
    >
        <template #formulario>
            <h5 class="fw-bold mb-4">
                Datos del <span v-if="producto.es_plan">plan</span>
                <span v-else>servicio</span>
            </h5>
            <div class="row mb-4">
                <!-- Nombre -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <label class="form-label">Nombre</label>
                    <input
                        v-model="producto.nombre"
                        :disabled="disabled"
                        name="nombre"
                        type="text"
                        class="form-control"
                        placeholder="Obligatorio"
                    />
                </div>

                <!-- Categoria -->
                <div v-if="!producto.es_plan" class="col-md-6 col-lg-4 mb-4">
                    <label class="form-label">Categoria</label>
                    <select-input
                        v-model="producto.categoria"
                        label="nombre"
                        placeholder="Seleccione..."
                        :disabled="disabled"
                        :options="categorias"
                        :reduce="(item) => item.id"
                    >
                    </select-input>
                </div>

                <!-- Es plan -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <br />
                    <div class="form-check">
                        <input
                            v-model="producto.es_plan"
                            class="form-check-input"
                            type="checkbox"
                            id="es_plan"
                        />
                        <label class="form-check-label" for="es_plan">
                            Es plan
                        </label>
                    </div>
                </div>

                <!-- Descripcion -->
                <div class="col-12 mb-4">
                    <label class="form-label">Descripción</label>
                    <vue-editor
                        v-model="producto.descripcion"
                        :disabled="disabled"
                    ></vue-editor>
                </div>

                <!-- Estado -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <label class="form-label"
                        >Estado del <span v-if="producto.es_plan">plan</span>
                        <span v-else>servicio</span>
                    </label>
                    <select-input
                        v-model="producto.estado"
                        label="descripcion"
                        placeholder="Seleccione..."
                        :disabled="disabled"
                        :options="estadosProductoListado"
                        :reduce="(item) => item.id"
                    >
                    </select-input>
                </div>

                <!-- Precio unitario -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <label class="form-label">Precio unitario</label>
                    <div class="input-group">
                        <span class="input-group-text">US$</span>
                        <cleave
                            v-model="producto.precio_unitario"
                            :options="CONFIG_DECIMALES"
                            class="form-control"
                            :disabled="disabled"
                            placeholder="Obligatorio"
                        />
                    </div>
                </div>

                <!-- Gravable -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="form-check">
                        <br />
                        <input
                            v-model="producto.gravable"
                            class="form-check-input"
                            type="checkbox"
                            :disabled="disabled"
                            id="gravable"
                        />
                        <label class="form-check-label" for="gravable">
                            Cobrar IVA
                        </label>
                    </div>
                </div>

                <!-- Imagen -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <label class="form-label">Imagen</label>
                    <selector-imagen
                        :archivo="producto.imagen"
                        @change="setBase64($event)"
                        :disabled="disabled"
                    ></selector-imagen>
                </div>

                <!-- Url video (Youtube) -->
                <div v-if="!producto.es_plan" class="col-md-6 col-lg-8 mb-4">
                    <label class="form-label">Url video</label>
                    <input
                        v-model="producto.url_video"
                        :disabled="disabled"
                        type="text"
                        class="form-control"
                        placeholder="Opcional"
                    />
                </div>

                <!-- Boton obtener ahora -->
                <div class="col-12 mb-4">
                    <label class="form-label"
                        >Url destino</label
                    >
                    <input
                        v-model="producto.url_destino"
                        :disabled="disabled"
                        type="text"
                        class="form-control"
                        placeholder="Obligatorio"
                    />
                </div>
            </div>
        </template>
    </tab-layout>
</template>

<script src="./ServicioPage.ts"></script>
