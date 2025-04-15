<template>
    <layout-pedidos
        :configuracion-columnas="configuracionColumnas"
        :mixin="mixin"
        :mostrar-tab-formulario="mostrarFormulario"
        descripcion-pagina="Gestiona los pedidos realizados por tus clientes."
        icono-pagina="bi-clipboard"
    >
        <template #formulario>
            <h5 class="fw-bold mb-4">Datos del pedido</h5>
            <div class="row mb-4">
                <!-- Pedido -->
                <div class="col-md-4 mb-4">
                    <label class="form-label d-block">Pedido</label>
                    {{ pedido.pedido }}
                </div>

                <!-- Fecha emision -->
                <div class="col-md-4 mb-4">
                    <label class="form-label d-block">Fecha emisión</label>
                    {{ pedido.fecha_emision }}
                </div>

                <!-- Metodo pago -->
                <!-- <div class="col-md-4 mb-4">
                    <label class="form-label d-block">Método de pago</label>
                    {{ pedido.metodo_pago }}
                </div> -->

                <!-- Direccion -->
                <div
                    v-if="pedido.tipo_pedido === 'DOMICILIO'"
                    class="col-md-4 mb-4"
                >
                    <label class="form-label d-block">Dirección envío</label>
                    {{ pedido.direccion_envio }}
                </div>

                <div v-if="pedido.comentario" class="col-md-4 mb-4">
                    <label class="form-label d-block">Comentario</label>
                    {{ pedido.comentario }}
                </div>
            </div>

            <hr class="separador mb-4" />
            <h5 class="fw-bold mb-4">Datos del cliente</h5>
            <div class="row mb-4">
                <!-- Cliente -->
                <div class="col-md-4 mb-4">
                    <label class="form-label d-block">Cliente</label>
                    {{
                        pedido.cliente?.nombre +
                        " " +
                        (pedido.cliente?.apellidos != null
                            ? pedido.cliente?.apellidos
                            : "")
                    }}
                </div>

                <!-- Identificacion -->
                <div class="col-md-4 mb-4">
                    <label class="form-label d-block">Identificación</label>
                    {{ pedido.cliente?.identificacion }}
                </div>

                <!-- Correo -->
                <div class="col-md-4 mb-4">
                    <label class="form-label d-block">Correo</label>
                    {{ pedido.cliente?.correo }}
                </div>

                <!-- Celular -->
                <div class="col-md-4 mb-4">
                    <label class="form-label d-block">Celular</label>
                    {{ pedido.cliente?.celular }}
                </div>
            </div>

            <hr class="separador mb-4" />
            <h5 class="fw-bold mb-4">Servicios</h5>
            <div class="row mb-5">
                <div class="col-12">
                    <table class="table align-middle table-hover">
                        <thead>
                            <tr>
                                <th>Servicio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ pedido.servicio }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr class="separador mb-4" />
            <h5 class="fw-bold mb-4">Respuestas</h5>
            <div class="row mb-5">
                <div class="col-md-6">
                    <label class="form-label"
                        >¿Cuenta con su reporte de crédito?</label
                    >
                    <p class="fw-bold">{{ pedido.tiene_reporte }}</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label"
                        >¿Conoce qué puntaje (score) tiene actualmente?</label
                    >
                    <p class="fw-bold">{{ pedido.conoce_puntaje }}</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label">¿Tiene deudas vencidas?</label>
                    <p class="fw-bold">{{ pedido.tiene_deudas }}</p>
                </div>

                <div class="col-md-6">
                    <label class="form-label"
                        >¿Es cliente actual de Buró de Crédito Ecuador?</label
                    >
                    <p class="fw-bold">{{ pedido.es_cliente }}</p>
                </div>
            </div>

            <h5 class="fw-bold mb-4">
                {{
                    pedido.estado_pago?.charAt(0).toUpperCase() +
                    pedido.estado_pago?.slice(1).toLowerCase()
                }}
                <i
                    v-if="pedido.estado_pago === 'PAGADO'"
                    class="bi-check-circle-fill text-success"
                ></i>
                <i
                    v-else-if="pedido.estado_pago === 'ANULADO'"
                    class="bi-check-circle-fill text-danger"
                ></i>
                <i v-else class="bi-check-circle"></i>
            </h5>
            <div class="row text-end mb-4">
                <div class="col mb-4 d-flex flex-column">
                    <!-- IVA -->
                    <div class="mb-2">
                        <label class="form-label me-2">IVA (incluido):</label>
                        $ {{ pedido.iva }}
                    </div>

                    <!-- Subtotal -->
                    <div class="mb-2">
                        <label class="form-label me-2">Subtotal:</label>
                        $ {{ pedido.subtotal }}
                    </div>

                    <!-- Total -->
                    <div class="mb-4">
                        <label class="form-label me-2">Total:</label> $
                        {{ pedido.total }}
                    </div>

                    <!-- Pagado por el cliente -->
                    <div class="mb-2">
                        <label class="form-label me-2"
                            >Pagado por el cliente:</label
                        >
                        $
                        {{ pedido.pago_cliente }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
                    <button
                        v-if="
                            pedido.estado_pago !== estadosPago.anulado &&
                            pedido.estado_pago !== estadosPago.pagado
                        "
                        class="btn btn-success text-white"
                        @click="registrarPago()"
                    >
                        <i class="bi-cash-coin me-2"></i>Registrar pago
                    </button>
                    <button
                        v-if="
                            pedido.estado_pago !== estadosPago.anulado &&
                            pedido.estado_pago !== estadosPago.pagado
                        "
                        class="btn btn-danger text-white"
                        @click="anular()"
                    >
                        <i class="bi-hand-thumbs-down-fill me-2"></i>Anular
                        pedido
                    </button>
                    <button
                        v-if="pedido.estado_pago === estadosPago.anulado"
                        class="btn btn-danger text-white"
                        @click="eliminar()"
                    >
                        <i class="bi-trash me-2"></i>Eliminar pedido
                    </button>
                    <a
                        v-if="pedido.estado_pago === estadosPago.pagado"
                        class="btn btn-primary"
                        :href="'/admin/pedidos/download-pdf/' + pedido.id"
                    >
                        <i class="bi-printer me-2"></i>Imprimir
                    </a>
                    <button
                        v-if="
                            pedido.estado_pago === estadosPago.pagado &&
                            pedido.metodo_pago === metodosPago.deposito
                        "
                        class="btn btn-secondary text-white"
                        @click="consultarPago()"
                    >
                        <i class="bi-eye me-2"></i>Consultar pago
                    </button>
                    <button class="btn btn-light" @click="verListado()">
                        <i class="bi-arrow-return-right me-2"></i>Volver
                    </button>
                </div>
            </div>
        </template>
    </layout-pedidos>
</template>

<script src="./PedidoPage.ts"></script>
