<template>
    <div class="p-2">
        <div class="py-2 cinta-cabecera">
            <span>Inicio</span>
            <span>Mantenimientos</span>
            <span>Consultas/Reporte</span>
            <span>Transacción</span>
        </div>

        <div class="desenfoque pb-4">
            <!-- Header -->
            <div class="d-flex justify-content-between p-4">
                <img src="img/logo.webp" height="50" />
                <span class="bg-fecha"
                    >Fecha de consulta {{ fechaActual }}</span
                >
            </div>

            <!-- Datos de credito -->
            <h4 class="titulo-seccion p-4 mb-4" :class="{ 'text-h6': xs }">
                REPORTE DE CRÉDITO {{ reporte.tipo_reporte }}
            </h4>

            <div class="row px-4 mb-4">
                <div class="col-12">
                    <table :class="{ 'w-50': true, 'mx-auto': true }">
                        <tbody>
                            <tr>
                                <td
                                    class="bg-grey-3 text-center fw-bold w-50"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    Documento de identidad
                                </td>
                                <td
                                    class="text-center w-50"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    {{ reporte.identificacion_cliente }}
                                </td>
                            </tr>
                            <tr>
                                <td
                                    class="bg-grey-3 text-center fw-bold"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    Nombres
                                </td>
                                <td
                                    class="text-center"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    {{ reporte.nombres_cliente }}
                                </td>
                            </tr>
                            <tr>
                                <td
                                    class="bg-grey-3 text-center fw-bold"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    Edad
                                </td>
                                <td
                                    class="text-center"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    {{ reporte.edad_cliente }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Datos de contacto -->
            <h5 class="titulo-seccion py-2 mb-3" :class="{ 'text-h6': xs }">
                DATOS DE CONTACTO
            </h5>
            <div class="row px-4 mb-4">
                <div class="col-12">
                    <table :class="{ 'w-50': true, 'mx-auto': true }">
                        <tbody>
                            <tr>
                                <td
                                    class="bg-grey-3 text-center fw-bold w-50"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    Celular
                                </td>
                                <td
                                    class="text-center w-50"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    {{ reporte.celular_cliente }}
                                </td>
                            </tr>
                            <tr>
                                <td
                                    class="bg-grey-3 text-center fw-bold"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    Correo
                                </td>
                                <td
                                    class="text-center"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    {{ reporte.correo_cliente }}
                                </td>
                            </tr>
                            <tr>
                                <td
                                    class="bg-grey-3 text-center fw-bold"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    Dirección
                                </td>
                                <td
                                    class="text-center"
                                    :class="{ 'mini-texto': xs }"
                                >
                                    {{ reporte.direccion_cliente }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Informacion laboral -->
            <h5 class="titulo-seccion py-2 mb-3" :class="{ 'text-h6': xs }">
                INFORMACIÓN LABORAL
            </h5>
            <div v-if="reporte.tiene_informacion_laboral" class="row px-4 mb-4">
                <div class="col-12">
                    <table :class="{ 'mini-texto': xs }">
                        <tbody>
                            <tr>
                                <td class="bg-grey-3 q-pl-md fw-bold w-25">
                                    Ruc empleador
                                </td>
                                <td class="q-pl-md w-25">
                                    {{ reporte.ruc_empleador }}
                                </td>
                                <td class="bg-grey-3 q-pl-md fw-bold w-25">
                                    Tipo empresa
                                </td>
                                <td class="q-pl-md w-25">
                                    {{ reporte.tipo_empresa }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Nombre empresa
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.nombre_empresa }}
                                </td>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Código sucursal
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.codigo_sucursal }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Teléfono sucursal
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.telefono_sucursal }}
                                </td>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Dirección sucursal
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.direccion_sucursal }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Fax sucursal
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.fax_sucursal }}
                                </td>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Dirección afiliado
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.direccion_afiliado }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Teléfono afiliado
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.telefono_afiliado }}
                                </td>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Ocupación afiliado
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.ocupacion_afiliado }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Celular afiliado
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.celular_afiliado }}
                                </td>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Email afiliado
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.email_afiliado }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Salario afiliado
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.salario_afiliado }}
                                </td>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Fecha ingreso
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.fecha_ingreso }}
                                </td>
                            </tr>

                            <tr>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Fecha salida
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.fecha_salida }}
                                </td>
                                <td class="bg-grey-3 q-pl-md fw-bold">
                                    Ubicación empresa
                                </td>
                                <td class="q-pl-md">
                                    {{ reporte.ubicacion_empresa }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
            </p>

            <!-- Servicio de Rentas Internas -->
            <h5 class="titulo-seccion py-2 mb-3">
                SERVICIO DE RENTAS INTERNAS (SRI)
            </h5>
            <div v-if="reporte.tiene_ruc" class="row px-4 mb-4">
                <div class="col-12 mb-4">
                    <table>
                        <tbody>
                            <tr>
                                <td class="bg-grey-3 text-center fw-bold w-50">
                                    RUC
                                </td>
                                <td class="text-center w-50">
                                    {{ reporte.ruc_cliente }}
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-grey-3 text-center fw-bold">
                                    Razón social
                                </td>
                                <td class="text-center">
                                    {{ reporte.razon_social }}
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-grey-3 text-center fw-bold">
                                    Estado contribuyente en el RUC
                                </td>
                                <td class="text-center">
                                    <span
                                        :class="{
                                            'text-positive':
                                                reporte.estado_contribuyente,
                                            'text-negative':
                                                !reporte.estado_contribuyente,
                                        }"
                                        ><b>{{
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
                    <table>
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
                    <table>
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
                        :configuracion-columnas="
                            configuracionColumnasActividades
                        "
                        :elementos="reporte.actividadesEconomicas"
                    ></table-view>
                </div>
            </div>
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
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
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
            </p>

            <!-- Decreto 333 -->
            <h5 class="titulo-seccion py-2 mb-3">DECRETO 333</h5>
            <div class="row px-4 mb-4">
                <div class="col-12 text-center">
                    <span
                        v-if="reporte.beneficiado_333"
                        class="d-flex align-items-center justify-content-center"
                        ><q-icon
                            name="bi-check-circle-fill"
                            class="q-mr-sm"
                            color="positive"
                            size="sm"
                        ></q-icon
                        >USTED ES BENEFICIADO DEL DECRETO 333</span
                    >
                    <span
                        v-else
                        class="d-flex align-items-center justify-content-center"
                        ><q-icon
                            name="bi-x-circle-fill"
                            class="q-mr-sm"
                            color="negative"
                            size="sm"
                        ></q-icon
                        >USTED NO HA SIDO BENEFICIADO DEL DECRETO 333</span
                    >
                </div>
            </div>

            <div class="page-break"></div>

            <!-- Resumen -->
            <h5 class="titulo-seccion py-2 mb-3">RESUMEN</h5>
            <div v-if="reporte.tiene_resumen">
                <div class="row px-4 mb-4">
                    <div class="col-12 overflow-auto mb-3">
                        <table class="w-50 mx-auto">
                            <tbody>
                                <tr>
                                    <!-- Saldo -->
                                    <td
                                        class="ps-2 bg-grey-3 fw-bold w-25 text-no-wrap"
                                    >
                                        Saldo total operaciones impagos
                                    </td>
                                    <td
                                        class="text-center fs-3 fw-bold w-25 text-no-wrap"
                                    >
                                        $ {{ reporte.saldo_impagos }}
                                    </td>
                                    <!-- Total -->
                                    <td
                                        class="ps-2 bg-grey-3 fw-bold w-25 text-no-wrap"
                                    >
                                        Total operaciones impagos
                                    </td>
                                    <td
                                        class="text-center fs-3 fw-bold w-25 text-no-wrap"
                                    >
                                        {{ reporte.total_impagos }}
                                    </td>
                                </tr>

                                <tr>
                                    <!-- Saldo -->
                                    <td
                                        class="ps-2 bg-grey-3 fw-bold text-no-wrap"
                                    >
                                        Saldo total operaciones demanda judicial
                                    </td>
                                    <td class="text-center fs-3 fw-bold">
                                        $ {{ reporte.saldo_demanda_judicial }}
                                    </td>
                                    <!-- Total -->
                                    <td
                                        class="ps-2 bg-grey-3 fw-bold text-no-wrap"
                                    >
                                        Total operaciones demanda judicial
                                    </td>
                                    <td class="text-center fs-3 fw-bold">
                                        {{ reporte.total_demanda_judicial }}
                                    </td>
                                </tr>

                                <tr>
                                    <!-- Saldo -->
                                    <td
                                        class="ps-2 bg-grey-3 fw-bold text-no-wrap"
                                    >
                                        Saldo total operaciones cartera
                                        castigada
                                    </td>
                                    <td class="text-center fs-3 fw-bold">
                                        $ {{ reporte.saldo_cartera_castigada }}
                                    </td>
                                    <!-- Total -->
                                    <td
                                        class="ps-2 bg-grey-3 fw-bold text-no-wrap"
                                    >
                                        Total operaciones cartera castigada
                                    </td>
                                    <td class="text-center fs-3 fw-bold">
                                        {{ reporte.total_cartera_castigada }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <deslizar-movil></deslizar-movil>
                </div>
            </div>
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
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
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
            </p>

            <!-- Score -->
            <h5 class="titulo-seccion py-2 mb-3">SCORES</h5>
            <div v-if="reporte.tiene_puntuaciones">
                <div class="row px-4 mb-4">
                    <div class="col-12 text-center mb-4">
                        <contador
                            titulo="Score crediticio"
                            :valor="reporte.score_crediticio ?? 10"
                        ></contador>
                    </div>

                    <div class="col-12 text-center">
                        <contador
                            titulo="Score sobreendeudamiento"
                            :valor="reporte.score_sobreendeudamiento ?? 10"
                        ></contador>
                    </div>
                </div>
            </div>
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
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
                        :dense="true"
                    ></table-view>
                </div>
            </div>
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
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
                        :dense="true"
                    ></table-view>
                </div>
            </div>
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
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
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
            </p>

            <!-- Cuota mensual buro de credito -->
            <h5 class="titulo-seccion py-2 mb-3">
                CUOTA MENSUAL BURÓ DE CRÉDITO
            </h5>
            <div v-if="reporte.tiene_cuota_mensual">
                <div class="text-center fw-bold fs-1 px-4 mb-4">
                    <div class="col-12 text-center">
                        <contador-precio
                            titulo="Cuota"
                            :valor="reporte.cuota_mensual"
                        ></contador-precio>
                    </div>
                </div>
            </div>
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
            </p>

            <div class="page-break"></div>

            <!-- Consultas -->
            <h5 class="titulo-seccion py-2 mb-3">
                INSTITUCIONES QUE HAN REVISADO SU BURÓ DE CRÉDITO
            </h5>
            <div class="px-4 mb-4">
                <table-view
                    v-if="reporte.tiene_consultas"
                    :configuracion-columnas="
                        configuracionColumnasConsultasCliente
                    "
                    :elementos="reporte.consultasCliente"
                    estilos="w-50 mx-auto"
                ></table-view>
                <p v-else class="text-center q-pb-md">
                    <q-icon
                        name="bi-info-circle-fill"
                        class="q-mr-sm"
                        color="info"
                        size="sm"
                    ></q-icon
                    >CLIENTE NO POSEE CONSULTAS EN EL ÚLTIMO AÑO FISCAL
                </p>
            </div>

            <div class="page-break"></div>

            <!-- Resumen vencimientos -->
            <h5 class="titulo-seccion py-2 mb-3">RESUMEN DE VENCIMIENTOS</h5>
            <div v-if="reporte.tiene_resumen_vencimientos">
                <div class="px-4 mb-4">
                    <table-view
                        :configuracion-columnas="
                            configuracionColumnasVencimientos
                        "
                        :elementos="reporte.vencimientos"
                    ></table-view>
                </div>
            </div>
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
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
                    <p class="q-pt-md">
                        <b>Mantiene historial crediticio desde: </b
                        >{{ reporte.historial_crediticio_desde }}
                    </p>
                </div>
            </div>
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
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
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
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
            <p v-else class="text-center q-pb-md">
                <q-icon
                    name="bi-info-circle-fill"
                    class="q-mr-sm"
                    color="info"
                    size="sm"
                ></q-icon
                >EL CLIENTE NO POSEE DATOS PARA EL SEGMENTO
            </p>
        </div>
    </div>
</template>

<script lang="ts">
import { configuracionColumnasActividades } from "../domain/configuracionColumnasActividades"
import { configuracionColumnasEstablecimientos } from "../domain/configuracionColumnasEstablecimientos"
import { configuracionColumnasOperacionesCredito } from "../domain/configuracionColumnasOperacionesCredito"
import { configuracionColumnasHistorialCrediticio } from "../domain/configuracionColumnasHistorialCrediticio"
import { configuracionColumnasConsultasCliente } from "../domain/configuracionColumnasConsultasCliente"
import { configuracionColumnasMorosidades } from "../domain/configuracionColumnasMorosidades"
import { configuracionColumnasVencimientos } from "../domain/configuracionColumnasVencimientos"
import { configuracionColumnasSaldosPorVencer } from "../domain/configuracionColumnasSaldosPorVencer"
import { configuracionColumnasOperacionesCanceladas } from "../domain/configuracionColumnasOperacionesCanceladas"
import { configuracionColumnasSeguros } from "../domain/configuracionColumnasSeguros"

import { computed, defineComponent, ref } from "vue"

// Componentes
import TableViewHistorialCrediticio from "./TableViewHistorialCrediticio.vue"
import TableView from "./TableView.vue"
import Contador from "./ContadorComponent.vue"
import ContadorPrecio from "./ContadorPrecio.vue"
import DeslizarMovil from "./DeslizarMovil.vue"
import { EjemploReporte } from "../domain/EjemploReporte"

export default defineComponent({
    // props: ["reporte"],
    components: {
        TableView,
        TableViewHistorialCrediticio,
        Contador,
        ContadorPrecio,
        DeslizarMovil,
    },
    setup(props) {
        const reporte = new EjemploReporte()

        const fechaActual = new Date().toLocaleDateString()

        const totalEstablecimientos = computed(() => {
            if (reporte.establecimientos) {
                return reporte.establecimientos.length
            }
            return 0
        })

        const scoreCrediticio = ref(reporte.score_crediticio)
        const scoreSobreendeudamiento = ref(reporte.score_sobreendeudamiento)

        // scoreCrediticio.value = computed(() => props.reporte.score_crediticio)
        /* scoreSobreendeudamiento.value = computed(
        () => props.reporte.score_sobreendeudamiento
      ) */
        const xs = computed(() => window.screen.width <= 576)

        return {
            reporte,
            fechaActual,
            totalEstablecimientos,
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
            scoreCrediticio,
            scoreSobreendeudamiento,
            xs,
        }
    },
})
</script>

<style lang="scss" scoped>
.bg-fecha {
    background-color: #eee;
    padding: 16px;
    border-radius: 8px;
}

.cinta-cabecera {
    background-color: #2e5496;
    color: #fff;
    display: flex;
    justify-content: space-around;
}

.titulo-seccion {
    background-color: #ffffff86;
    text-align: center;
    font-weight: bold;
}

thead {
    background-color: #eee;
}

table {
    border-collapse: collapse;
    width: 100%;

    td,
    th {
        border: 1px solid;
    }
}

.desenfoque {
    backdrop-filter: blur(10PX);
    background-color: #ffffff86;
}
</style>
