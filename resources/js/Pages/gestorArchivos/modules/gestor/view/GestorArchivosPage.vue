<template>
    <sidebar-layout>
        <h3 class="fs-5 mb-4 fw-bold">
            <i class="bi-folder me-2"></i>Gestor de archivos
        </h3>
        <p class="text-color">
            Crea carpetas, sube archivos y asígnalos a tus clientes.
        </p>

        <div class="card alto100vh">
            <div class="card-header">
                <div class="d-flex align-items-center gap-3">
                    <transition name="bounce">
                        <button
                            v-if="mostrarRegresar"
                            type="button"
                            class="btn btn-light btn-sm border border-1 rounded-3 btn-regresar"
                            @click="cargarSubnivel(carpetaPadre)"
                        >
                            <i class="bi-chevron-left"></i>
                        </button>
                    </transition>
                    <span>
                        <i class="bi-collection me-2 d-inline-block py-1"></i
                        >Gestor de archivos
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div
                    v-if="carpetas.length || archivos.length"
                    class="table-responsive-sm"
                >
                    <table class="table table-hover align-middle w-100">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Propietario</th>
                                <th class="text-nowrap">Tamaño de archivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(carpeta, index) in carpetas"
                                :key="index"
                                class="cursor-pointer item-file-folder"
                            >
                                <td @click="cargarSubnivel(carpeta.id)">
                                    <i
                                        class="bi-folder-fill text-success fs-4 me-2"
                                    ></i>
                                    {{ carpeta.nombre }}
                                </td>
                                <td @click="cargarSubnivel(carpeta.id)">
                                    {{ carpeta.usuario }}
                                </td>
                                <td @click="cargarSubnivel(carpeta.id)">--</td>
                                <td>
                                    <custom-dropdown
                                        v-if="carpeta.id"
                                        :id-entidad="carpeta.id"
                                        :opciones="opcionesCarpetas"
                                    ></custom-dropdown>
                                </td>
                            </tr>

                            <tr
                                v-for="(archivo, index) in archivos"
                                :key="index"
                                class="cursor-pointer item-file-folder"
                            >
                                <td>
                                    <i
                                        class="fs-4 me-2"
                                        :class="
                                            'bi-filetype-' +
                                            extraerExtension(
                                                archivo.nombre ?? ''
                                            )
                                        "
                                    ></i>
                                    {{ archivo.nombre }}
                                </td>
                                <td>{{ usuarioPropietario }}</td>
                                <td>
                                    {{ formatBytes(archivo.tamanio_bytes) }}
                                </td>
                                <td>
                                    <custom-dropdown
                                        v-if="archivo.id"
                                        :id-entidad="archivo.id"
                                        :opciones="opcionesArchivos"
                                    ></custom-dropdown>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>Sin contenido.</div>
            </div>
        </div>
        <floating-button
            v-if="puedeCrearRecursos"
            :id-carpeta-actual="carpetaActual ?? undefined"
            :opciones="opcionesCrearRecursos"
        ></floating-button>

        <listado-seleccionable
            ref="refListadoSeleccionable"
            :configuracion-columnas="configuracionColumnas"
            :elementos="listado"
            @seleccionar="seleccionar"
        ></listado-seleccionable>
    </sidebar-layout>
</template>

<script lang="ts" src="./GestorArchivosPage.ts"></script>

<style lang="scss" scoped>
/* .item-file-folder {
    > * {
        transition: transform 0.4s ease;
    }

    &:hover {
        font-weight: bold;

        > * {
            transform: translateX(4px);
        }
    }
} */

.alto100vh {
    height: calc(100vh - 180px);
}
</style>
