<template>
    <sidebar-layout>
        <main>
            <h3 class="fs-5 mb-4 fw-bold">
                <i class="bi-clipboard me-2"></i>Consultar reportes
            </h3>
            <p class="text-color">Consulta los reportes de tus clientes.</p>

            <div class="card card-body mb-3">
                <div class="d-flex flex-wrap gap-2">
                    <div class="flex-grow-1">
                        <label class="form-label"
                            >Identificación del cliente</label
                        >
                        <input
                            v-model="criterioBusquedaUsuario"
                            type="text"
                            class="form-control"
                            placeholder="Ingrese identificación del cliente y luego presione la tecla Enter"
                            @keydown.enter="listarUsuarios()"
                        />
                    </div>

                    <div class="flex-shrink-1 align-self-end">
                        <button
                            class="btn btn-success text-white"
                            @click="obtenerListado()"
                        >
                            <i class="bi-search me-2"></i>
                            Buscar
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Listado -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="bi-list me-2"></i>Listado de reportes
                        </div>
                        <div class="card-body">
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasWithEvents
                                "
                                :elementos="listado"
                            ></listado>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <listado-seleccionable
            ref="refListadoSeleccionableUsuario"
            :configuracion-columnas="configuracionColumnasUsuario"
            :elementos="listadoUsuarios"
            @seleccionar="seleccionarUsuario"
        ></listado-seleccionable>
    </sidebar-layout>
</template>

<script src="./ConsultarReportePage.ts"></script>
