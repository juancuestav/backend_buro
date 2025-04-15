<template>
    <div class="py-1 cinta-cabecera">
        <span>Inicio</span>
        <span>Mantenimientos</span>
        <span>Consultas/Reporte</span>
        <span>Transacción</span>
    </div>

    <div class="bg-white">
        <!-- Header -->
        <div class="d-flex justify-content-between p-4">
            <img src="/img/logo.webp" height="50" />
            <span class="bg-fecha">Fecha de consulta {{ fechaActual }}</span>
        </div>

        <!-- Datos de credito -->
        <h4 class="titulo-seccion p-4 mb-4">
            REPORTE DE CRÉDITO {{ reporte.tipo_reporte }}
        </h4>

        <div class="row px-4 mb-4">
            <div class="col-12">
                <table class="table table-sm border border-1 w-100">
                    <tbody>
                        <tr>
                            <td class="bg-light text-center fw-bold w-50">
                                Documento de identidad
                            </td>
                            <td class="text-center w-50">
                                {{ reporte.identificacion_cliente }}
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light text-center fw-bold">
                                Nombres
                            </td>
                            <td class="text-center">
                                {{ reporte.nombres_cliente }}
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light text-center fw-bold">Edad</td>
                            <td class="text-center">
                                {{ reporte.edad_cliente }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Datos de contacto -->
        <h5 class="titulo-seccion py-2 mb-3">DATOS DE CONTACTO</h5>
        <div class="row px-4 mb-4">
            <div class="col-12">
                <table class="table table-sm border border-1 w-100">
                    <tbody>
                        <tr>
                            <td class="bg-light text-center fw-bold w-50">
                                Celular
                            </td>
                            <td class="text-center w-50">
                                {{ reporte.celular_cliente }}
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light text-center fw-bold">Correo</td>
                            <td class="text-center">
                                {{ reporte.correo_cliente }}
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light text-center fw-bold">
                                Dirección
                            </td>
                            <td class="text-center">
                                {{ reporte.direccion_cliente }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Informacion laboral -->
        <h5 class="titulo-seccion py-2 mb-3">INFORMACIÓN LABORAL</h5>
        <div v-if="reporte.tiene_informacion_laboral" class="row px-4 mb-4">
            <div class="col-12">
                <table class="table table-sm border border-1 w-100">
                    <tbody>
                        <tr>
                            <td class="bg-light ps-3 fw-bold w-25">
                                Ruc empleador
                            </td>
                            <td class="ps-3 w-25">
                                {{ reporte.ruc_empleador }}
                            </td>
                            <td class="bg-light ps-3 fw-bold w-25">
                                Tipo empresa
                            </td>
                            <td class="ps-3 w-25">
                                {{ reporte.tipo_empresa }}
                            </td>
                        </tr>

                        <tr>
                            <td class="bg-light ps-3 fw-bold">
                                Nombre empresa
                            </td>
                            <td class="ps-3">
                                {{ reporte.nombre_empresa }}
                            </td>
                            <td class="bg-light ps-3 fw-bold">
                                Código sucursal
                            </td>
                            <td class="ps-3">
                                {{ reporte.codigo_sucursal }}
                            </td>
                        </tr>

                        <tr>
                            <td class="bg-light ps-3 fw-bold">
                                Teléfono sucursal
                            </td>
                            <td class="ps-3">
                                {{ reporte.telefono_sucursal }}
                            </td>
                            <td class="bg-light ps-3 fw-bold">
                                Dirección sucursal
                            </td>
                            <td class="ps-3">
                                {{ reporte.direccion_sucursal }}
                            </td>
                        </tr>

                        <tr>
                            <td class="bg-light ps-3 fw-bold">Fax sucursal</td>
                            <td class="ps-3">
                                {{ reporte.fax_sucursal }}
                            </td>
                            <td class="bg-light ps-3 fw-bold">
                                Dirección afiliado
                            </td>
                            <td class="ps-3">
                                {{ reporte.direccion_afiliado }}
                            </td>
                        </tr>

                        <tr>
                            <td class="bg-light ps-3 fw-bold">
                                Teléfono afiliado
                            </td>
                            <td class="ps-3">
                                {{ reporte.telefono_afiliado }}
                            </td>
                            <td class="bg-light ps-3 fw-bold">
                                Ocupación afiliado
                            </td>
                            <td class="ps-3">
                                {{ reporte.ocupacion_afiliado }}
                            </td>
                        </tr>

                        <tr>
                            <td class="bg-light ps-3 fw-bold">
                                Celular afiliado
                            </td>
                            <td class="ps-3">
                                {{ reporte.celular_afiliado }}
                            </td>
                            <td class="bg-light ps-3 fw-bold">
                                Email afiliado
                            </td>
                            <td class="ps-3">
                                {{ reporte.email_afiliado }}
                            </td>
                        </tr>

                        <tr>
                            <td class="bg-light ps-3 fw-bold">
                                Salario afiliado
                            </td>
                            <td class="ps-3">
                                {{ reporte.salario_afiliado }}
                            </td>
                            <td class="bg-light ps-3 fw-bold">Fecha ingreso</td>
                            <td class="ps-3">
                                {{ reporte.fecha_ingreso }}
                            </td>
                        </tr>

                        <tr>
                            <td class="bg-light ps-3 fw-bold">Fecha salida</td>
                            <td class="ps-3">
                                {{ reporte.fecha_salida }}
                            </td>
                            <td class="bg-light ps-3 fw-bold">
                                Ubicación empresa
                            </td>
                            <td class="ps-3">
                                {{ reporte.ubicacion_empresa }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <!-- Servicio de Rentas Internas -->
        <h5 class="titulo-seccion py-2 mb-3">
            SERVICIO DE RENTAS INTERNAS (SRI)
        </h5>
        <div v-if="reporte.tiene_ruc" class="row px-4 mb-4">
            <div class="col-12">
                <table class="table table-sm border border-1 w-100">
                    <tbody>
                        <tr>
                            <td class="bg-light text-center fw-bold w-50">
                                RUC
                            </td>
                            <td class="text-center w-50">
                                {{ reporte.ruc_cliente }}
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light text-center fw-bold">
                                Razón social
                            </td>
                            <td class="text-center">
                                {{ reporte.razon_social }}
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light text-center fw-bold">
                                Estado contribuyente en el RUC
                            </td>
                            <td class="text-center">
                                <span
                                    :class="{
                                        'text-success':
                                            reporte.estado_contribuyente,
                                        'text-danger':
                                            !reporte.estado_contribuyente,
                                    }"
                                    ><b class="ps-2">{{
                                        reporte.estado_contribuyente
                                            ? "ACTIVO"
                                            : "NO ACTIVO"
                                    }}</b></span
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="page-break"></div>

            <div class="col-12 mb-4">
                <table class="table border border-1 w-100">
                    <thead>
                        <tr>
                            <th>Tipo de contribuyente</th>
                            <th>Clase de contribuyente</th>
                            <th>Obligado a llevar contabilidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ reporte.tipo_contribuyente }}</td>
                            <td>{{ reporte.clase_contribuyente }}</td>
                            <td class="ps-2">
                                {{
                                    reporte.obligado_llevar_contabilidad
                                        ? "SI"
                                        : "NO"
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-12 mb-4">
                <table class="table border border-1 w-100">
                    <thead>
                        <tr>
                            <th>Fecha inicio de actividades</th>
                            <th>Fecha actualización</th>
                            <th>Fecha cese actividades</th>
                            <th>Fecha reinicio actividades</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ reporte.fecha_inicio_actividades }}
                            </td>
                            <td>{{ reporte.fecha_actualización }}</td>
                            <td>
                                {{ reporte.fecha_cese_actividades }}
                            </td>
                            <td>
                                {{ reporte.fecha_reinicio_actividades }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-12">
                <table-view
                    :configuracion-columnas="configuracionColumnasActividades"
                    :elementos="reporte.actividadesEconomicas"
                ></table-view>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <!-- Establecimientos -->
        <h5 class="titulo-seccion py-2 mb-3">ESTABLECIMIENTO MATRIZ</h5>
        <div v-if="reporte.tiene_establecimientos">
            <p class="text-center">
                Lista de establecimientos -
                {{ totalEstablecimientos }} registro(s)
            </p>
            <div class="px-4 mb-4">
                <table-view
                    :configuracion-columnas="
                        configuracionColumnasEstablecimientos
                    "
                    :elementos="reporte.establecimientos"
                ></table-view>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <!-- Decreto 333 -->
        <h5 class="titulo-seccion py-2 mb-3">DECRETO 333</h5>
        <div class="row px-4 mb-4">
            <div class="col-12 text-center">
                <span
                    v-if="reporte.beneficiado_333"
                    class="d-flex align-items-center justify-content-center"
                    ><i class="bi-check-circle-fill fs-1 text-success me-2"></i
                    >USTED ES BENEFICIADO DEL DECRETO 333</span
                >
                <span
                    v-else
                    class="d-flex align-items-center justify-content-center"
                    ><i class="bi-x-circle-fill fs-1 text-danger me-2"></i>USTED
                    NO HA SIDO BENEFICIADO DEL DECRETO 333</span
                >
            </div>
        </div>

        <div class="page-break"></div>

        <!-- Resumen -->
        <h5 class="titulo-seccion py-2 mb-3">RESUMEN</h5>
        <div v-if="reporte.tiene_resumen">
            <div class="row px-4 mb-4">
                <div class="col-12">
                    <table class="table border border-1 w-100">
                        <tbody>
                            <tr>
                                <!-- Saldo -->
                                <td class="ps-2 bg-light fw-bold w-25">
                                    Saldo total operaciones impagos
                                </td>
                                <td class="text-center fs-3 fw-bold w-25">
                                    $ {{ reporte.saldo_impagos }}
                                </td>
                                <!-- Total -->
                                <td class="ps-2 bg-light fw-bold w-25">
                                    Total operaciones impagos
                                </td>
                                <td class="text-center fs-3 fw-bold w-25">
                                    {{ reporte.total_impagos }}
                                </td>
                            </tr>

                            <tr>
                                <!-- Saldo -->
                                <td class="ps-2 bg-light fw-bold">
                                    Saldo total operaciones demanda judicial
                                </td>
                                <td class="text-center fs-3 fw-bold">
                                    $ {{ reporte.saldo_demanda_judicial }}
                                </td>
                                <!-- Total -->
                                <td class="ps-2 bg-light fw-bold">
                                    Total operaciones demanda judicial
                                </td>
                                <td class="text-center fs-3 fw-bold">
                                    {{ reporte.total_demanda_judicial }}
                                </td>
                            </tr>

                            <tr>
                                <!-- Saldo -->
                                <td class="ps-2 bg-light fw-bold">
                                    Saldo total operaciones cartera castigada
                                </td>
                                <td class="text-center fs-3 fw-bold">
                                    $ {{ reporte.saldo_cartera_castigada }}
                                </td>
                                <!-- Total -->
                                <td class="ps-2 bg-light fw-bold">
                                    Total operaciones cartera castigada
                                </td>
                                <td class="text-center fs-3 fw-bold">
                                    {{ reporte.total_cartera_castigada }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <!-- Resumen morosidades -->
        <h5 class="titulo-seccion py-2 mb-3">
            TOTAL DE DEUDA REPORTADA A LA CENTRAL DE RIESGOS
        </h5>
        <div v-if="reporte.tiene_resumen_morosidades" class="px-4 mb-4">
            <table-view
                :configuracion-columnas="configuracionColumnasMorosidades"
                :elementos="reporte.morosidades"
            ></table-view>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <!-- Score -->
        <h5 class="titulo-seccion py-2 mb-3">SCORES</h5>
        <div v-if="reporte.tiene_puntuaciones">
            <div class="row px-4 mb-4">
                <div class="col-12 text-center">
                    <contador
                        titulo="Score crediticio"
                        :valor="reporte.score_crediticio"
                    ></contador>
                </div>
                <div class="col-12 text-center">
                    <contador
                        titulo="Score sobreendeudamiento"
                        :valor="reporte.score_sobreendeudamiento"
                    ></contador>
                </div>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <div class="page-break"></div>

        <!-- Operaciones de credito bancaria -->
        <h5 class="titulo-seccion py-2 mb-3">
            OPERACIONES DE CRÉDITO BANCARIAS
        </h5>
        <div v-if="reporte.tiene_operaciones_credito_bancarias">
            <div class="px-4 mb-4">
                <table-view
                    :configuracion-columnas="
                        configuracionColumnasOperacionesCredito
                    "
                    :elementos="reporte.operacionesCreditoBancarias"
                ></table-view>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <!-- Operaciones de credito comerciales -->
        <h5 class="titulo-seccion py-2 mb-3">
            OPERACIONES DE CRÉDITO COMERCIALES
        </h5>
        <div v-if="reporte.tiene_operaciones_credito_comerciales">
            <div class="px-4 mb-4">
                <table-view
                    :configuracion-columnas="
                        configuracionColumnasOperacionesCredito
                    "
                    :elementos="reporte.operacionesCreditoComerciales"
                ></table-view>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <div class="page-break"></div>

        <h5 class="titulo-seccion py-2 mb-3">SEGMENTACIÓN DE RIESGO</h5>
        <div class="px-4 mb-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>Segmentación</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background-color: #0cdd77">
                        <td>AAA - Cliente excelente</td>
                        <td>930 - 999 puntos</td>
                    </tr>
                    <tr style="background-color: #beff6f">
                        <td>AA - Cliente bueno</td>
                        <td>850 - 929</td>
                    </tr>
                    <tr style="background-color: #f7fee7">
                        <td>A - Cliente regular</td>
                        <td>700 - 849</td>
                    </tr>
                    <tr style="background-color: #fef200">
                        <td>B - Cliente bajo</td>
                        <td>400 - 699</td>
                    </tr>
                    <tr style="background-color: #ff0600">
                        <td>C - Cliente malo</td>
                        <td>Bajo 400</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Historial crediticio -->
        <h5 class="titulo-seccion py-2 mb-3">
            HISTORIAL CREDITICIO PERÍODO 3 ÚLTIMOS AÑOS
        </h5>
        <div v-if="reporte.tiene_historial">
            <div class="px-4 mb-4">
                <table-view-historial-crediticio
                    :configuracion-columnas="
                        configuracionColumnasHistorialCrediticio
                    "
                    :elementos="reporte.historialCrediticio"
                ></table-view-historial-crediticio>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <!-- Cuota mensual buro de credito -->
        <h5 class="titulo-seccion py-2 mb-3">CUOTA MENSUAL BURÓ DE CRÉDITO</h5>
        <div v-if="reporte.tiene_cuota_mensual">
            <div class="text-center fw-bold fs-1 px-4 mb-4">
                <div class="col-12 text-center">
                    <contador-precio
                        titulo="Cuota"
                        :valor="parseFloat(reporte.cuota_mensual)"
                    ></contador-precio>
                </div>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <div class="page-break"></div>

        <!-- Consultas -->
        <h5 class="titulo-seccion py-2 mb-3">
            INSTITUCIONES QUE HAN REVISADO SU BURÓ DE CRÉDITO
        </h5>
        <div class="px-4 mb-4">
            <table-view
                v-if="reporte.tiene_consultas"
                :configuracion-columnas="configuracionColumnasConsultasCliente"
                :elementos="reporte.consultasCliente"
            ></table-view>
            <p v-else class="text-center pb-4">
                <i class="bi-info-circle-fill me-2 text-info"></i>CLIENTE NO
                POSEE CONSULTAS EN EL ÚLTIMO AÑO FISCAL
            </p>
        </div>

        <div class="page-break"></div>

        <!-- Resumen vencimientos -->
        <h5 class="titulo-seccion py-2 mb-3">RESUMEN DE VENCIMIENTOS</h5>
        <div v-if="reporte.tiene_resumen_vencimientos">
            <div class="px-4 mb-4">
                <table-view
                    :configuracion-columnas="configuracionColumnasVencimientos"
                    :elementos="reporte.vencimientos"
                ></table-view>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <!-- Analisis de saldos por vencer -->
        <h5 class="titulo-seccion py-2 mb-3">
            ANÁLISIS DE SALDOS POR VENCER SISTEMA FINANCIERO
        </h5>
        <div v-if="reporte.tiene_saldos_por_vencer">
            <div class="px-4 mb-4">
                <table-view
                    :configuracion-columnas="
                        configuracionColumnasSaldosPorVencer
                    "
                    :elementos="reporte.saldosPorVencer"
                ></table-view>
                <p>
                    <b>Mantiene historial crediticio desde: </b
                    >{{ reporte.historial_crediticio_desde }}
                </p>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <div class="page-break"></div>

        <!-- Ultimas 10 operaciones canceladas -->
        <h5 class="titulo-seccion py-2 mb-3">
            ÚLTIMAS 10 OPERACIONES CANCELADAS
        </h5>
        <div v-if="reporte.tiene_operaciones_canceladas">
            <div class="px-4 mb-4">
                <table-view
                    :configuracion-columnas="
                        configuracionColumnasOperacionesCanceladas
                    "
                    :elementos="reporte.operacionesCanceladas"
                ></table-view>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>

        <!-- Informacion de seguros -->
        <h5 class="fw-bold text-center">INFORMACIÓN DE SEGUROS</h5>
        <div v-if="reporte.tiene_informacion_seguros">
            <div class="px-4 mb-4">
                <table-view
                    :configuracion-columnas="configuracionColumnasSeguros"
                    :elementos="reporte.seguros"
                ></table-view>
            </div>
        </div>
        <p v-else class="text-center pb-4">
            <i class="bi-info-circle-fill me-2 text-info"></i>EL CLIENTE NO
            POSEE DATOS PARA EL SEGMENTO
        </p>
    </div>
</template>

<script lang="ts">
import { configuracionColumnasActividades } from "../../../domain/configuracionColumnasActividades"
import { configuracionColumnasEstablecimientos } from "../../../domain/configuracionColumnasEstablecimientos"
import { configuracionColumnasOperacionesCredito } from "../../../domain/configuracionColumnasOperacionesCredito"
import { configuracionColumnasHistorialCrediticio } from "../../../domain/configuracionColumnasHistorialCrediticio"
import { configuracionColumnasConsultasCliente } from "../../../domain/configuracionColumnasConsultasCliente"
import { configuracionColumnasMorosidades } from "../../../domain/configuracionColumnasMorosidades"
import { configuracionColumnasVencimientos } from "../../../domain/configuracionColumnasVencimientos"
import { configuracionColumnasSaldosPorVencer } from "../../../domain/configuracionColumnasSaldosPorVencer"
import { configuracionColumnasOperacionesCanceladas } from "../../../domain/configuracionColumnasOperacionesCanceladas"
import { configuracionColumnasSeguros } from "../../../domain/configuracionColumnasSeguros"

import { computed, defineComponent } from "vue"

// Componentes
import TableView from "@components/listado/TableView.vue"
import TableViewHistorialCrediticio from "@components/listado/TableViewHistorialCrediticio.vue"
import Contador from "@components/Contador.vue"
import ContadorPrecio from "@components/ContadorPrecio.vue"

export default defineComponent({
    props: ["reporte"],
    components: {
        TableView,
        TableViewHistorialCrediticio,
        Contador,
        ContadorPrecio,
    },
    setup(props) {
        const fechaActual = new Date().toLocaleDateString()

        const totalEstablecimientos = computed(() => {
            if (props.reporte.establecimientos) {
                return props.reporte.establecimientos.length
            }
            return 0
        })

        return {
            fechaActual,
            totalEstablecimientos,
            // configuracion columnas
            configuracionColumnasActividades,
            configuracionColumnasEstablecimientos,
            configuracionColumnasOperacionesCredito,
            configuracionColumnasHistorialCrediticio,
            configuracionColumnasConsultasCliente,
            configuracionColumnasMorosidades,
            configuracionColumnasVencimientos,
            configuracionColumnasSaldosPorVencer,
            configuracionColumnasOperacionesCanceladas,
            configuracionColumnasSeguros,
        }
    },
})
</script>

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
