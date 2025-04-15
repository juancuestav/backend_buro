<template>
    <div
        class="container-fluid py-4 d-flex justify-content-between position-fixed top-0 bg-white shadow-sm botones"
    >
        <button class="btn btn-primary" @click="volver()">
            <i class="bi-chevron-left me-2"></i>Regresar
        </button>
        <button class="btn btn-secondary" @click="imprimir()">
            <i class="bi-printer me-2"></i>Imprimir
        </button>
    </div>

    <div class="pt-5 mt-5">
        <div ref="refPDF">
            <reporte-preview :reporte="reporte"></reporte-preview>
        </div>
    </div>
</template>

<script src="./PreviewReporteCliente.ts"></script>

<style lang="scss" scoped>
.botones {
    z-index: 5;
}
.bg-fecha {
    background-color: #eee;
    padding: 16px;
}

.cinta-cabecera {
    background-color: #2e5496;
    color: #fff;
    display: flex;
    justify-content: space-around;
}

.titulo-seccion {
    background-color: #eee;
    text-align: center;
    font-weight: bold;
}

thead {
    background-color: #eee;
}
</style>
