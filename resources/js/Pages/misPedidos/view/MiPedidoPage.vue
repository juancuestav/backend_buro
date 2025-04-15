<template>
    <sidebar-layout>
        <main>
            <h3 class="fs-5 mb-4 fw-bold">
                <i class="bi-clipboard me-2"></i>Mis pedidos
            </h3>
            <p class="text-color">
                Consulta tus pedidos de servicios.
            </p>

            <div class="row">
                <!-- Listado -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="bi-list me-2"></i>Listado de pedidos
                        </div>
                        <div class="card-body">
                            <listado
                                :configuracion-columnas="configuracionCols"
                                :elementos="listado"
                                :permitir-exportar="false"
                                :permitir-ocultar-columnas="false"
                            ></listado>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </sidebar-layout>
</template>

<script src="./MiPedidoPage.ts"></script>
