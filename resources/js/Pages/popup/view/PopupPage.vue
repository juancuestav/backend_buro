<template>
    <card-layout
        titulo-modal="Publicidad en popup"
        titulo-panel="Panel de publicidad en popup"
        textoBotonCrearModal="Crear publicidad"
        :mixin="mixin"
    >
        <template #formulario>
            <form id="formulario" @submit.prevent>
                <div class="row">
                    <!-- Titulo -->
                    <div class="col-12 mb-4">
                        <label class="form-label" for="name">Titulo</label>
                        <input
                            v-model="publicidad.titulo"
                            type="text"
                            class="form-control"
                            placeholder="Obligatorio"
                        />
                    </div>

                    <!-- URL Destino -->
                    <div class="col-12 mb-4">
                        <label class="form-label" for="name">URL destino</label>
                        <input
                            v-model="publicidad.url_destino"
                            type="text"
                            class="form-control"
                            placeholder="Obligatorio"
                            @blur="resetearNuevaPestana()"
                        />
                    </div>

                    <!-- Nueva pestaña -->
                    <div v-show="publicidad.url_destino" class="col-12 mb-4">
                        <div class="form-check">
                            <input
                                v-model="publicidad.nueva_pestana"
                                class="form-check-input"
                                type="checkbox"
                                id="pestana"
                            />
                            <label class="form-check-label" for="pestana">
                                Abrir en nueva pestaña
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label">Imagen</label>
                        <selector-imagen
                            :archivo="publicidad.imagen"
                            @change="setBase64($event)"
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
        </template>
    </card-layout>
</template>

<script lang="ts" src="./PopupPage.ts"></script>
