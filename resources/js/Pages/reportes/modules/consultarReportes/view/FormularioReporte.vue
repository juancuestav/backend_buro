<template>
    <sidebar-layout>
        <h3 class="fs-5 mb-4 fw-bold">
            <i class="bi-clipboard-data me-2"></i>Formulario de reportes
        </h3>
        <p class="text-color">
            Crea reportes personalizados y asígnalos a tus clientes.
        </p>

        <div v-if="reporte">
            <!--  -->
            <div class="card mb-2">
                <collapse titulo="Reporte">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Tipo</label>
                            <select-input
                                v-model="reporte.tipo_reporte"
                                label="descripcion"
                                placeholder="Seleccione..."
                                :options="tiposReportes"
                                :reduce="(item) => item.id"
                            >
                            </select-input>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="form-check">
                                <br />
                                <input
                                    v-model="reporte.beneficiado_333"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="beneficiado_333"
                                />
                                <label
                                    class="form-check-label"
                                    for="beneficiado_333"
                                >
                                    Beneficiado del decreto 333
                                </label>
                            </div>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Datos del cliente">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label class="form-label"
                                >Documento de identidad</label
                            >
                            <input
                                v-model="criterioBusquedaUsuario"
                                type="text"
                                class="form-control"
                                @keydown.enter="listarUsuarios()"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Nombre</label>
                            <input
                                v-model="reporte.nombres_cliente"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Edad</label>
                            <input
                                v-model="reporte.edad_cliente"
                                type="number"
                                class="form-control"
                                min="0"
                            />
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Datos de contacto">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label class="form-label">Celular</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-telephone"></i>
                                </div>
                                <cleave
                                    v-model="reporte.celular_cliente"
                                    :options="CONFIG_CELULAR"
                                    class="form-control"
                                />
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Correo</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-envelope"></i>
                                </div>
                                <input
                                    v-model="reporte.correo_cliente"
                                    type="email"
                                    class="form-control"
                                />
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Dirección</label>
                            <input
                                v-model="reporte.direccion_cliente"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Información laboral">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_informacion_laboral"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="informacion_laboral"
                                />
                                <label
                                    class="form-check-label"
                                    for="informacion_laboral"
                                >
                                    El cliente posee datos para el segmento
                                </label>
                            </div>
                        </div>
                    </div>

                    <div v-if="reporte.tiene_informacion_laboral" class="row">
                        <div class="col-md-4 mb-4">
                            <label class="form-label">Ruc empleador</label>
                            <cleave
                                v-model="reporte.ruc_empleador"
                                :options="CONFIG_RUC"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Tipo empresa</label>
                            <input
                                v-model="reporte.tipo_empresa"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Nombre empresa</label>
                            <input
                                v-model="reporte.nombre_empresa"
                                type="text"
                                class="form-control"
                            />
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="form-label">Código sucursal</label>
                            <input
                                v-model="reporte.codigo_sucursal"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Telefono sucursal</label>
                            <input
                                v-model="reporte.telefono_sucursal"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Dirección sucursal</label>
                            <input
                                v-model="reporte.direccion_sucursal"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Fax sucursal</label>
                            <input
                                v-model="reporte.fax_sucursal"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Dirección afiliado</label>
                            <input
                                v-model="reporte.direccion_afiliado"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Teléfono afiliado</label>
                            <input
                                v-model="reporte.telefono_afiliado"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Ocupación afiliado</label>
                            <input
                                v-model="reporte.ocupacion_afiliado"
                                type="text"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Celular afiliado</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-telephone"></i>
                                </div>
                                <cleave
                                    v-model="reporte.celular_afiliado"
                                    :options="CONFIG_CELULAR"
                                    class="form-control"
                                />
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Email afiliado</label>
                            <input
                                v-model="reporte.email_afiliado"
                                type="email"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Salario afiliado</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-currency-dollar"></i>
                                </div>
                                <cleave
                                    v-model="reporte.salario_afiliado"
                                    :options="CONFIG_DECIMALES"
                                    class="form-control"
                                />
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Fecha ingreso</label>
                            <input
                                v-model="reporte.fecha_ingreso"
                                type="date"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Fecha salida</label>
                            <input
                                v-model="reporte.fecha_salida"
                                type="date"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label">Ubicación empresa</label>
                            <input
                                v-model="reporte.ubicacion_empresa"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
            <collapse titulo="Servicio de Rentas Internas (SRI)">
                <div class="row">
                    <div class="col-12">
                        <div class="form-check">
                            <input
                                v-model="reporte.tiene_ruc"
                                class="form-check-input"
                                type="checkbox"
                                id="ruc"
                            />
                            <label class="form-check-label" for="ruc">
                                Tiene RUC
                            </label>
                        </div>
                    </div>
                </div>

                <div v-if="reporte.tiene_ruc" class="row pt-4">
                    <div class="col-md-4 mb-4">
                        <label class="form-label">RUC</label>
                        <cleave
                            v-model="reporte.ruc_cliente"
                            :options="CONFIG_RUC"
                            class="form-control"
                        />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="form-label">Razón social</label>
                        <input
                            v-model="reporte.razon_social"
                            type="text"
                            class="form-control"
                        />
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="form-check">
                            <br />
                            <input
                                v-model="reporte.estado_contribuyente"
                                class="form-check-input"
                                type="checkbox"
                                id="estado_contribuyente"
                            />
                            <label
                                class="form-check-label"
                                for="estado_contribuyente"
                            >
                                Estado contribuyente en el RUC
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="form-check">
                            <br />
                            <input
                                v-model="reporte.obligado_llevar_contabilidad"
                                class="form-check-input"
                                type="checkbox"
                                id="obligado_llevar_contabilidad"
                            />
                            <label
                                class="form-check-label"
                                for="obligado_llevar_contabilidad"
                            >
                                Obligado a llevar contabilidad
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4">
                        <label class="form-label">Tipo de contribuyente</label>
                        <select-input
                            v-model="reporte.tipo_contribuyente"
                            label="descripcion"
                            placeholder="Seleccione..."
                            :options="tiposContribuyente"
                            :reduce="(item) => item.id"
                        >
                        </select-input>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="form-label">Clase contribuyente</label>
                        <input
                            v-model="reporte.clase_contribuyente"
                            type="text"
                            class="form-control"
                        />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="form-label"
                            >Fecha inicio actividades</label
                        >
                        <input
                            v-model="reporte.fecha_inicio_actividades"
                            type="date"
                            class="form-control"
                        />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="form-label">Fecha actualización</label>
                        <input
                            v-model="reporte.fecha_actualización"
                            type="date"
                            class="form-control"
                        />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="form-label">Fecha cese actividades</label>
                        <input
                            v-model="reporte.fecha_cese_actividades"
                            type="date"
                            class="form-control"
                        />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label class="form-label"
                            >Fecha reinicio actividades</label
                        >
                        <input
                            v-model="reporte.fecha_reinicio_actividades"
                            type="date"
                            class="form-control"
                        />
                    </div>

                    <div class="col-12 mb-3">
                        <listado
                            :configuracion-columnas="
                                configuracionColumnasActividades
                            "
                            :elementos="actividadesEconomicas"
                            :context-menu="contextMenu"
                            :permitir-ocultar-columnas="false"
                            :permitir-exportar="false"
                            :alto-fijo="false"
                        ></listado>
                    </div>
                </div>
            </collapse>
        </div>

            <div class="card mb-2">
                <collapse titulo="Establecimiento matriz">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_establecimientos"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="establecimientos"
                                />
                                <label
                                    class="form-check-label"
                                    for="establecimientos"
                                >
                                    Tiene establecimientos
                                </label>
                            </div>
                        </div>
                        <div
                            v-show="reporte.tiene_establecimientos"
                            class="col-12 mb-3"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasEstablecimientos
                                "
                                :elementos="establecimientos"
                                :context-menu="contextMenuEstablecimientos"
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                                :alto-fijo="false"
                            ></listado>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Resumen">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_resumen"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="resumen"
                                />
                                <label class="form-check-label" for="resumen">
                                    Tiene resumen
                                </label>
                            </div>
                        </div>
                    </div>
                    <div v-show="reporte.tiene_resumen" class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label"
                                >Saldo total operaciones impagos</label
                            >
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-currency-dollar"></i>
                                </div>
                                <cleave
                                    v-model="reporte.saldo_impagos"
                                    :options="CONFIG_DECIMALES"
                                    class="form-control"
                                />
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label"
                                >Total operaciones impagos</label
                            >
                            <input
                                v-model="reporte.total_impagos"
                                class="form-control"
                                type="number"
                                min="0"
                            />
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label"
                                >Saldo total operaciones demanda judicial</label
                            >
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-currency-dollar"></i>
                                </div>
                                <cleave
                                    v-model="reporte.saldo_demanda_judicial"
                                    :options="CONFIG_DECIMALES"
                                    class="form-control"
                                />
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label"
                                >Total operaciones demanda judicial</label
                            >
                            <input
                                v-model="reporte.total_demanda_judicial"
                                class="form-control"
                                type="number"
                                min="0"
                            />
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label"
                                >Saldo total operaciones cartera
                                castigada</label
                            >
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-currency-dollar"></i>
                                </div>
                                <cleave
                                    v-model="reporte.saldo_cartera_castigada"
                                    :options="CONFIG_DECIMALES"
                                    class="form-control"
                                />
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label"
                                >Total operaciones cartera castigada</label
                            >
                            <input
                                v-model="reporte.total_cartera_castigada"
                                class="form-control"
                                type="number"
                                min="0"
                            />
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Resumen de morosidades">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_resumen_morosidades"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="resumen_morosidades"
                                />
                                <label
                                    class="form-check-label"
                                    for="resumen_morosidades"
                                >
                                    Tiene resumen morosidades
                                </label>
                            </div>
                        </div>
                        <div
                            v-show="reporte.tiene_resumen_morosidades"
                            class="col-12 mb-3"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasMorosidades
                                "
                                :elementos="morosidades"
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                                :altoFijo="false"
                            ></listado>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Puntuaciones">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_puntuaciones"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="puntuaciones"
                                />
                                <label
                                    class="form-check-label"
                                    for="puntuaciones"
                                >
                                    Tiene puntuaciones
                                </label>
                            </div>
                        </div>
                    </div>
                    <div v-show="reporte.tiene_puntuaciones" class="row">
                        <div class="col-md-4 mb-4">
                            <label class="form-label">Score crediticio</label>
                            <input
                                v-model="reporte.score_crediticio"
                                type="number"
                                class="form-control"
                            />
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label"
                                >Score sobreendeudamiento</label
                            >
                            <input
                                v-model="reporte.score_sobreendeudamiento"
                                type="number"
                                class="form-control"
                            />
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Operaciones de crédito bancarias">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    v-model="
                                        reporte.tiene_operaciones_credito_bancarias
                                    "
                                    class="form-check-input"
                                    type="checkbox"
                                    id="operaciones_credito_bancarias"
                                />
                                <label
                                    class="form-check-label"
                                    for="operaciones_credito_bancarias"
                                >
                                    Tiene operaciones de crédito bancarias
                                </label>
                            </div>
                        </div>
                        <div
                            v-show="reporte.tiene_operaciones_credito_bancarias"
                            class="col-12"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasOperacionesCredito
                                "
                                :elementos="operacionesCreditoBancarias"
                                :context-menu="contextMenuOperacionesCredito"
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                                :alto-fijo="false"
                            ></listado>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Operaciones de crédito comerciales">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    v-model="
                                        reporte.tiene_operaciones_credito_comerciales
                                    "
                                    class="form-check-input"
                                    type="checkbox"
                                    id="operaciones_credito_comerciales"
                                />
                                <label
                                    class="form-check-label"
                                    for="operaciones_credito_comerciales"
                                >
                                    Tiene operaciones de crédito comerciales
                                </label>
                            </div>
                        </div>
                        <div
                            v-show="
                                reporte.tiene_operaciones_credito_comerciales
                            "
                            class="col-12"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasOperacionesCredito
                                "
                                :elementos="operacionesCreditoComerciales"
                                :context-menu="
                                    contextMenuOperacionesCreditoComerciales
                                "
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                                :alto-fijo="false"
                            ></listado>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Historial crediticio">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_historial"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="historial"
                                />
                                <label class="form-check-label" for="historial">
                                    El cliente posee historial crediticio
                                </label>
                            </div>
                        </div>

                        <div
                            v-show="reporte.tiene_historial"
                            class="col-12 mb-3"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasHistorialCrediticio
                                "
                                :elementos="historialCrediticio"
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                            ></listado>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Cuota mensual buró de crédito">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_cuota_mensual"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="cuota_mensual"
                                />
                                <label
                                    class="form-check-label"
                                    for="cuota_mensual"
                                >
                                    Tiene cuota mensual
                                </label>
                            </div>
                        </div>
                        <div
                            v-show="reporte.tiene_cuota_mensual"
                            class="col-md-4 mb-3"
                        >
                            <label class="form-label">Cuota mensual</label>
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class="bi-currency-dollar"></i>
                                </div>
                                <cleave
                                    v-model="reporte.cuota_mensual"
                                    :options="CONFIG_DECIMALES"
                                    class="form-control"
                                />
                            </div>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse
                    titulo="Instituciones que han revisado su buró de crédito"
                >
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_consultas"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="consultas"
                                />
                                <label class="form-check-label" for="consultas">
                                    El cliente tiene consultas
                                </label>
                            </div>
                        </div>

                        <div
                            v-show="reporte.tiene_consultas"
                            class="col-12 mb-3"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasConsultasCliente
                                "
                                :elementos="consultasCliente"
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                                :alto-fijo="false"
                            ></listado>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Resumen de vencimientos">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_resumen_vencimientos"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="resumen_vencimientos"
                                />
                                <label
                                    class="form-check-label"
                                    for="resumen_vencimientos"
                                >
                                    El cliente tiene resumen de vencimientos
                                </label>
                            </div>
                        </div>

                        <div
                            v-show="reporte.tiene_resumen_vencimientos"
                            class="col-12 mb-3"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasVencimientos
                                "
                                :elementos="vencimientos"
                                :context-menu="contextMenuVencimientos"
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                                :alto-fijo="false"
                            ></listado>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse
                    titulo="Análisis de saldos por vencer Sistema Financiero"
                >
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_saldos_por_vencer"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="saldos_por_vencer"
                                />
                                <label
                                    class="form-check-label"
                                    for="saldos_por_vencer"
                                >
                                    El cliente tiene saldos por vencer
                                </label>
                            </div>
                        </div>
                        <div
                            v-show="reporte.tiene_saldos_por_vencer"
                            class="col-12 mb-3"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasSaldosPorVencer
                                "
                                :elementos="saldosPorVencer"
                                :context-menu="contextMenuSaldosPorVencer"
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                                :alto-fijo="false"
                            ></listado>
                        </div>

                        <div
                            v-show="reporte.tiene_saldos_por_vencer"
                            class="col-md-4 mb-4"
                        >
                            <label class="form-label"
                                >Mantiene historial crediticio desde</label
                            >
                            <input
                                v-model="reporte.historial_crediticio_desde"
                                class="form-control"
                                type="text"
                            />
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Últimas 10 operaciones canceladas">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input
                                    v-model="
                                        reporte.tiene_operaciones_canceladas
                                    "
                                    class="form-check-input"
                                    type="checkbox"
                                    id="operaciones_canceladas"
                                />
                                <label
                                    class="form-check-label"
                                    for="operaciones_canceladas"
                                >
                                    El cliente tiene operaciones canceladas
                                </label>
                            </div>
                        </div>
                        <div
                            v-show="reporte.tiene_operaciones_canceladas"
                            class="col-12 mb-3"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasOperacionesCanceladas
                                "
                                :elementos="operacionesCanceladas"
                                :context-menu="contextMenuOperacionesCanceladas"
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                                :alto-fijo="false"
                            ></listado>
                        </div>
                    </div>
                </collapse>
            </div>

            <div class="card mb-2">
                <collapse titulo="Información de seguros">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input
                                    v-model="reporte.tiene_informacion_seguros"
                                    class="form-check-input"
                                    type="checkbox"
                                    id="informacion_seguros"
                                />
                                <label
                                    class="form-check-label"
                                    for="informacion_seguros"
                                >
                                    El cliente tiene información de seguros
                                </label>
                            </div>
                        </div>
                        <div
                            v-show="reporte.tiene_informacion_seguros"
                            class="col-12 mb-3"
                        >
                            <listado
                                :configuracion-columnas="
                                    configuracionColumnasSeguros
                                "
                                :elementos="seguros"
                                :permitir-ocultar-columnas="false"
                                :permitir-exportar="false"
                                :alto-fijo="false"
                            ></listado>
                        </div>
                    </div>
                </collapse>
            </div>
            <!--  -->

            <div class="generar-reporte">
                <button class="btn btn-primary" @click="volver()">
                    <i class="bi-chevron-left me-2"></i>Volver a consultar
                </button>
                <button class="btn btn-success text-white" @click="modificar()">
                    <i class="bi-save me-2"></i>Modificar reporte
                </button>
            </div>
        </div>
        <listado-seleccionable
            ref="refListadoSeleccionableUsuario"
            :configuracion-columnas="configuracionColumnasUsuario"
            :elementos="listadoUsuarios"
            @seleccionar="seleccionarUsuario"
        ></listado-seleccionable>
    </sidebar-layout>
</template>

<script src="./FormularioReporte.ts"></script>

<style scoped>
.generar-reporte {
    position: fixed;
    bottom: 24px;
    right: 24px;
    display: flex;
    gap: 16px;
}
</style>
