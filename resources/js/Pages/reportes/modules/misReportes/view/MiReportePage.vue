<template>
    <sidebar-layout>
        <main>
            <h3 class="fs-5 mb-4 fw-bold">
                <i class="bi-clipboard me-2"></i>Mis reportes
            </h3>
            <p class="text-color">Consulta tus reportes.</p>

            <div class="row">
                <!-- Listado -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="bi-list me-2"></i>Listado de reportes
                        </div>
                        <div class="card-body">
                            <listado
                                :configuracion-columnas="configuracionColumnas"
                                :elementos="listado"
                                :permitir-exportar="puedeExportar"
                                :permitir-ocultar-columnas="puedeExportar"
                            ></listado>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </sidebar-layout>
</template>

<script src="./MiReportePage.ts"></script>
