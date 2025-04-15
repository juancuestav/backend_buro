<template>
    <sidebar-layout>
        <h1 class="fs-4 fw-bold text-center mb-4">BURÓ DE CRÉDITO ECUADOR</h1>
        <p class="text-center">Recopilación de información de los clientes.</p>

        <div class="row">
            <!-- Listado -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="bi-list me-2"></i>Listado de usuarios
                    </div>
                    <div class="card-body">
                        <listado
                            :configuracion-columnas="configuracionColumnas"
                            :elementos="listado"
                        ></listado>
                    </div>
                </div>
            </div>
        </div>
    </sidebar-layout>
</template>

<script src="./MarketingPage.ts"></script>
