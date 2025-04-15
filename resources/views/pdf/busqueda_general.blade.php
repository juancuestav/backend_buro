<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precalifica - Reporte</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            color: #333;
            padding: 15px;
            background-color: #f5f6f5;
            font-size: 14px;
        }

        .indice .page-number {
            float: right;
            color: #555;
        }

        /** Definir las reglas del pie de página **/
        footer {
            position: fixed;
            bottom: 0px;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            margin-bottom: 5px;

            /** Estilos extra personales **/
            text-align: center;
            color: #000000;
        }

        footer .page:after {
            content: counter(page);
            position: relative;
            right: 5px;
            background-color: darkcyan;
        }

        .q-page {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .report-title {
            color: #1a73e8;
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #1a73e8;
            padding-bottom: 5px;
        }

        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        h2 {
            color: #1a73e8;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 6px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            color: #555;
            font-weight: 600;
            width: 30%;
            vertical-align: top;
        }

        td {
            color: #666;
        }

        @media print {
            body {
                padding: 0;
            }

            .q-page {
                box-shadow: none;
                padding: 15px;
            }

            .section {
                margin-bottom: 15px;
            }

            th,
            td {
                padding: 4px 8px;
            }

            .report-title {
                font-size: 20px;
            }
        }

        @media screen and (max-width: 768px) {

            th,
            td {
                display: block;
                width: 100%;
            }

            th {
                background-color: #f8f9fa;
                border-bottom: none;
            }

            td {
                border-bottom: 1px solid #eee;
            }
        }
    </style>
</head>

<body>
    <!--<footer style="font-size: 10px; padding: 4px 32px 32px 32px; color: #1a202c;">
        <table style="width: 100%; border: none; border-top: 1px solid #1a202c;">
            <tr>
                <td style="width: 60%; line-height: normal; border: none;">
                    REPORTE DE PRECALIFICACIÓN
                </td>
                <td style="border: none;"></td>
            </tr>
            <tr>
                <td style="width: 60%; line-height: normal; border: none;">
                    Reporte generado el
                    {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('l, d \d\e F \d\e Y') }}
                </td>
            </tr>
        </table>
    </footer> -->
    <div class="q-page">
        <div class="report-title">Reporte de Precalificación</div>

        <div class="section">
            <h2>Registro Civil</h2>
            <table>
                <tr>
                    <th>Cédula</th>
                    <td>{{ $general['registro_civil']['cedula'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Cédula Cónyuge</th>
                    <td>{{ $general['registro_civil']['cedula_conyugue'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Apellidos y Nombres</th>
                    <td>{{ $general['registro_civil']['apellidos_nombres'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Sexo</th>
                    <td>{{ $general['registro_civil']['sexo'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Condición</th>
                    <td>{{ $general['registro_civil']['condicion'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha de Nacimiento</th>
                    <td>{{ $general['registro_civil']['fecha_nacimiento'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>País</th>
                    <td>{{ $general['registro_civil']['pais'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Estado Civil</th>
                    <td>{{ $general['registro_civil']['estado_civil'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Cónyuge</th>
                    <td>{{ $general['registro_civil']['conyugue'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Apellidos y Nombres del Padre</th>
                    <td>{{ $general['registro_civil']['apellidos_nombres_padre'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>País del Padre</th>
                    <td>{{ $general['registro_civil']['pais_padre'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Cédula del Padre</th>
                    <td>{{ $general['registro_civil']['cedula_padre'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Apellidos y Nombres de la Madre</th>
                    <td>{{ $general['registro_civil']['apellidos_nombres_madre'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>País de la Madre</th>
                    <td>{{ $general['registro_civil']['pais_madre'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Cédula de la Madre</th>
                    <td>{{ $general['registro_civil']['cedula_madre'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Dirección</th>
                    <td>{{ $general['registro_civil']['direccion'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha de Matrimonio</th>
                    <td>{{ $general['registro_civil']['fecha_matrimonio'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Puesto u Ocupación</th>
                    <td>{{ $general['registro_civil']['puesto_ocupacion'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Instrucción</th>
                    <td>{{ $general['registro_civil']['instruccion'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha de Emisión</th>
                    <td>{{ $general['registro_civil']['fecha_emision'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Código Dactilar</th>
                    <td>{{ $general['registro_civil']['codigo_dactilar'] ?? '' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>Buró de Crédito</h2>
            @foreach ($general['banco'] as $banco)
                <table>
                    <tr>
                        <th>Fecha</th>
                        <td>{{ $banco->fecha ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Tipo</th>
                        <td>{{ $banco->tipo ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Cédula/RUC</th>
                        <td>{{ $banco->cedula_ruc ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td>{{ $banco->nombre ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Código Entidad</th>
                        <td>{{ $banco->cod_entida ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Banco</th>
                        <td>{{ $banco->banco ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Nombre Entidad</th>
                        <td>{{ $banco->entnombre ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Tipo Entidad</th>
                        <td>{{ $banco->enttipo ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Vinculación</th>
                        <td>{{ $banco->vinculacio ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Riesgo</th>
                        <td>{{ $banco->riesgo ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Campo 1</th>
                        <td>{{ $banco->campo_1 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Calificación</th>
                        <td>{{ $banco->calificaci ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo Vigente</th>
                        <td>{{ $banco->saldo_vige ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>No Devengado</th>
                        <td>{{ $banco->no_dvenga ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo 0-1</th>
                        <td>{{ $banco->saldo_0_1 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo 1-2</th>
                        <td>{{ $banco->saldo_1_2 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo 2-3</th>
                        <td>{{ $banco->saldo_2_3 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo 3-6</th>
                        <td>{{ $banco->saldo_3_6 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo 6-9</th>
                        <td>{{ $banco->saldo_6_9 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo 9-12</th>
                        <td>{{ $banco->saldo_9_12 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo 12-2</th>
                        <td>{{ $banco->saldo_12_2 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo 24-3</th>
                        <td>{{ $banco->saldo_24_3 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Más de 36</th>
                        <td>{{ $banco->mas_36 ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Judicial</th>
                        <td>{{ $banco->judicial ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Castigo</th>
                        <td>{{ $banco->castigo ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Mora</th>
                        <td>{{ $banco->mora ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Saldo Mora</th>
                        <td>{{ $banco->saldo_mora ?? '' }}</td>
                    </tr>
                </table>

                <br />
            @endforeach

        </div>

        <div class="section">
            <h2>IESS</h2>
            <table>
                <tr>
                    <th>Ruc Empleador</th>
                    <td>{{ $general['iess']['ruc_empleador'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Tipo Empresa</th>
                    <td>{{ $general['iess']['tipo_empresa'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Nombre Empresa</th>
                    <td>{{ $general['iess']['nombre_empleador'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Código Sucursal</th>
                    <td>{{ $general['iess']['codigo_sucursal'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Teléfono Sucursal</th>
                    <td>{{ $general['iess']['telefono_sucursal'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Dirección Sucursal</th>
                    <td>{{ $general['iess']['direccion_sucursal'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fax Sucursal</th>
                    <td>{{ $general['iess']['fax_sucursal'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Dirección Afiliado</th>
                    <td>{{ $general['iess']['direccion_empleado'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Teléfono Afiliado</th>
                    <td>{{ $general['iess']['telefono_empleado'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Ocupación Afiliado</th>
                    <td>{{ $general['iess']['cargo_empleado'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Celular Afiliado</th>
                    <td>{{ $general['iess']['celular_empleado'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Email Afiliado</th>
                    <td>{{ $general['iess']['correo_empleado'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Salario Afiliado</th>
                    <td>{{ $general['iess']['sueldo_empleado'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha Ingreso</th>
                    <td>{{ $general['iess']['fecha_ingreso_empleado'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha Salida</th>
                    <td>{{ $general['iess']['fecha_salida_empleado'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Ubicación Empresa</th>
                    <td>{{ $general['iess']['direccion_sucursal'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Nombre Empleado</th>
                    <td>{{ $general['iess']['nombre_empleado'] ?? '' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>SRI</h2>
            <table>
                <tr>
                    <th>Número RUC</th>
                    <td>{{ $general['sri']['numero_ruc'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Razón Social</th>
                    <td>{{ $general['sri']['razon_social'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Nombre Fantasía Comercial</th>
                    <td>{{ $general['sri']['nombre_fantasia_comercial'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha Inscripción RUC</th>
                    <td>{{ $general['sri']['fecha_inscripcion_ruc'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Lista Blanca</th>
                    <td>{{ $general['sri']['lista_blanca'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha Inicio Actividades</th>
                    <td>{{ $general['sri']['fecha_inicio_actividades'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Valor Patrimonio</th>
                    <td>{{ $general['sri']['valor_patrimonio'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Obligado</th>
                    <td>{{ $general['sri']['obligado'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha Cancelación</th>
                    <td>{{ $general['sri']['fecha_cancelacion'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Pasaporte</th>
                    <td>{{ $general['sri']['pasaporte'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Calificación Artesanal</th>
                    <td>{{ $general['sri']['calificacion_artesanal'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha Calificación Artesanal</th>
                    <td>{{ $general['sri']['fecha_calificacion_artesanal'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha Solicitud Suspensión</th>
                    <td>{{ $general['sri']['fecha_solicitud_suspension'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha Suspensión Definitiva</th>
                    <td>{{ $general['sri']['fecha_suspension_definitiva'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Fecha Reinicio Actividades</th>
                    <td>{{ $general['sri']['fecha_reinicio_actividades'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Calle</th>
                    <td>{{ $general['sri']['calle'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Número</th>
                    <td>{{ $general['sri']['numero'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Intersección</th>
                    <td>{{ $general['sri']['interseccion'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td>{{ $general['sri']['telefono'] ?? '' }}</td>
                </tr>
                <tr>
                    <th>Correo Electrónico</th>
                    <td>{{ $general['sri']['correo_electronico'] ?? '' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>ANT</h2>
            @foreach ($general['ant'] as $ant)
                <table>
                    <tr>
                        <th>Placa</th>
                        <td>{{ $ant->placa ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Tipo identificación</th>
                        <td>{{ $ant->tipo_identificacion ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Identificación</th>
                        <td>{{ $ant->identificacion ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Nombre propietario</th>
                        <td>{{ $ant->nombre_propietario ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Telefono</th>
                        <td>{{ $ant->telefono ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Tipo dirección</th>
                        <td>{{ $ant->tipo_direccion ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td>{{ $ant->direccion ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Correo electrónico</th>
                        <td>{{ $ant->correo_electronico ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Motor</th>
                        <td>{{ $ant->motor ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Cilindraje</th>
                        <td>{{ $ant->cilindraje ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Chasis</th>
                        <td>{{ $ant->chasis ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Clase</th>
                        <td>{{ $ant->clase ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Tipo</th>
                        <td>{{ $ant->tipo ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Marca</th>
                        <td>{{ $ant->marca ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Modelo</th>
                        <td>{{ $ant->modelo ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Año</th>
                        <td>{{ $ant->anio ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Servicio</th>
                        <td>{{ $ant->servicio ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Año pagado</th>
                        <td>{{ $ant->anio_pagado ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Carga útil</th>
                        <td>{{ $ant->carga_util ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Tipo peso</th>
                        <td>{{ $ant->tipo_peso ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Peso</th>
                        <td>{{ $ant->peso ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Exoneración</th>
                        <td>{{ $ant->exoneracion ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Matriculado</th>
                        <td>{{ $ant->matriculado ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Última matricula</th>
                        <td>{{ $ant->ultima_matricula ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Ramv</th>
                        <td>{{ $ant->ramv ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Cantón</th>
                        <td>{{ $ant->canton ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Avaluo</th>
                        <td>{{ $ant->avaluo ?? '' }}</td>
                    </tr>
                </table>

                <br />
            @endforeach
        </div>
    </div>

    <script type="text/php">
        $pdf->page_script('
           $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "bold"); // Fuente en negrita
           $x = $pdf->get_width() - 134; // 100px desde el borde izquierdo
           $y = $pdf->get_height() - 78; // 30px desde el borde inferior
           $pdf->text($x, $y, "Página $PAGE_NUM de $PAGE_COUNT", $font, 8);
       ');
    </script>
</body>

</html>
