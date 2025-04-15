<template>
    <sidebar-layout>
        <h1 class="fs-4 fw-bold text-center mb-4">BURÓ DE CRÉDITO ECUADOR</h1>
        <p class="text-center">
            El más completo del mercado. Tu Informe de Crédito contiene el
            detalle de todas tus deudas y te permite conocer de qué forma te
            evalúan los bancos y otras instituciones financieras para obtener un
            crédito.
        </p>

        <div class="mb-4">
            <div v-if="facturacion && facturacion.pagado">
                <p class="text-success fw-bold pt-2">
                    <i class="bi-check-circle-fill me-2"></i>SU APP SE ENCUENTRA
                    ACTIVADA
                </p>
                PRÓXIMA FACTURACIÓN: <b>{{ fechaProximaFacturacion }}</b>
            </div>
            <div v-else class="fw-bold text-danger">
                PENDIENTE DE ACTIVACIÓN. DEBES ADQUIRIR UN PLAN.
            </div>
        </div>

        <div class="mb-4 text-center">
            <button
                class="btn btn-success text-white"
                @click="() => (verPlanes = !verPlanes)"
            >
                Ver planes
            </button>
        </div>

        <div v-show="verPlanes" class="row row-cols-md-3 row-cols-1">
            <div v-for="plan in planes" :key="plan.id" class="col mb-2">
                <div class="card">
                    <div class="card-body">
                        <img :src="plan.imagen" alt="" class="w-100" />
                        <div class="text-center fw-bold fs-4 mb-3">
                            {{ plan.nombre }}
                        </div>
                        <div v-html="plan.descripcion"></div>
                        <div class="text-center fs-4">
                            $
                            {{
                                parseFloat(plan.precio_unitario) +
                                parseFloat(plan.iva)
                            }}
                        </div>
                        <div v-if="plan.gravable" class="text-center">
                            IVA incluido
                        </div>
                        <div v-else class="text-center">Precio final</div>
                        <a
                            v-if="plan.url_destino"
                            :href="plan.url_destino"
                            target="_blank"
                            class="btn btn-success text-white w-100 my-3"
                            >Obtener ahora</a
                        >
                        <div class="text-center mb-3">
                            <i
                                class="bi-bookmark-check-fill me-2 text-success"
                            ></i
                            >TU COMPRA ES SEGURA
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="boton-whatsapp" class="flotante"></div>
    </sidebar-layout>
</template>

<script src="./ActivarAppPage.ts"></script>

<style>
.flotante {
    position: fixed;
    bottom: 12px;
    right: 20px;
}
</style>
