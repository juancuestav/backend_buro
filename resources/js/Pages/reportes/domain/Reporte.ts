import { obtenerMesesAnteriores } from "@/shared/utils"
import { Hidratable } from "@shared/entidad/Hidratable"
import * as moment from "moment"
import { Actividad } from "./Actividad"
import { Establecimiento } from "./Establecimiento"
import { Grafica } from "./Grafica"
import { ItemConsultasCliente } from "./ItemConsultasCliente"
import { ItemHistorialCrediticio } from "./ItemHistorialCrediticio"
import { ItemMorosidad } from "./ItemMorosidad"
import { ItemOperacionCancelada } from "./ItemOperacionCancelada"
import { ItemSaldoPorVencer } from "./ItemSaldoPorVencer"
import { ItemSeguro } from "./ItemSeguro"
import { ItemVencimiento } from "./ItemVencimiento"
import { OperacionCredito } from "./OperacionCredito"

export class Reporte extends Hidratable {
    tipo_reporte: string | null
    identificacion_cliente: string | null
    nombres_cliente: string | null
    razon_social: string | null
    edad_cliente: number | null
    celular_cliente: string | null
    correo_cliente: string | null
    direccion_cliente: string | null
    ruc_cliente: string | null
    tipo_contribuyente: string | null
    clase_contribuyente: string | null
    fecha_inicio_actividades: string | null
    fecha_actualización: string | null
    fecha_cese_actividades: string | null
    fecha_reinicio_actividades: string | null
    cuota_mensual: number
    usuario: number | null
    historial_crediticio_desde: string | null
    //
    tiene_consultas: boolean
    tiene_informacion_laboral: boolean
    tiene_historial: boolean
    tiene_establecimientos: boolean
    tiene_resumen: boolean
    tiene_puntuaciones: boolean
    tiene_resumen_morosidades: boolean
    tiene_operaciones_credito_bancarias: boolean
    tiene_operaciones_credito_comerciales: boolean
    tiene_cuota_mensual: boolean
    tiene_resumen_vencimientos: boolean
    tiene_saldos_por_vencer: boolean
    tiene_operaciones_canceladas: boolean
    tiene_informacion_seguros: boolean
    tiene_ruc: boolean
    // informacion laboral
    ruc_empleador: string | null
    tipo_empresa: string | null
    nombre_empresa: string | null
    codigo_sucursal: string | null
    telefono_sucursal: string | null
    direccion_sucursal: string | null
    fax_sucursal: string | null
    direccion_afiliado: string | null
    telefono_afiliado: string | null
    ocupacion_afiliado: string | null
    celular_afiliado: string | null
    email_afiliado: string | null
    salario_afiliado: string | null
    fecha_ingreso: string | null
    fecha_salida: string | null
    ubicacion_empresa: string | null
    // resumen
    saldo_impagos: number | null
    total_impagos: number | null
    saldo_demanda_judicial: number | null
    total_demanda_judicial: number | null
    saldo_cartera_castigada: number | null
    total_cartera_castigada: number | null
    // estados
    estado_contribuyente: boolean
    obligado_llevar_contabilidad: boolean
    beneficiado_333: boolean
    // listados
    actividadesEconomicas: Actividad[]
    operacionesCreditoBancarias: OperacionCredito[]
    operacionesCreditoComerciales: OperacionCredito[]
    saldosPorVencer: any[]
    establecimientos: Establecimiento[]
    graficas: Grafica[]
    historialCrediticio: ItemHistorialCrediticio[]
    consultasCliente: ItemConsultasCliente[]
    morosidades: ItemMorosidad[]
    vencimientos: ItemVencimiento[]
    operacionesCanceladas: ItemOperacionCancelada[]
    seguros: ItemSeguro[]
    // graficas
    score_crediticio: number | null
    score_sobreendeudamiento: number | null

    constructor() {
        super()
        this.tipo_reporte = "NORMAL"
        this.identificacion_cliente = ""
        this.nombres_cliente = ""
        this.razon_social = ""
        this.edad_cliente = 0
        this.celular_cliente = ""
        this.correo_cliente = ""
        this.direccion_cliente = ""
        this.ruc_cliente = ""
        this.tipo_contribuyente = ""
        this.clase_contribuyente = ""
        this.fecha_inicio_actividades = ""
        this.fecha_actualización = ""
        this.fecha_cese_actividades = ""
        this.fecha_reinicio_actividades = ""
        //
        this.tiene_consultas = false
        this.tiene_informacion_laboral = false
        this.tiene_historial = false
        this.tiene_establecimientos = false
        this.tiene_resumen = false
        this.tiene_puntuaciones = false
        this.tiene_resumen_morosidades = false
        this.tiene_operaciones_credito_bancarias = false
        this.tiene_operaciones_credito_comerciales = false
        this.tiene_cuota_mensual = false
        this.tiene_resumen_vencimientos = false
        this.tiene_saldos_por_vencer = false
        this.tiene_operaciones_canceladas = false
        this.tiene_informacion_seguros = false
        this.tiene_ruc = false
        //
        this.cuota_mensual = 0
        this.usuario = null
        this.historial_crediticio_desde = null
        // informacion laboral
        this.ruc_empleador = null
        this.tipo_empresa = null
        this.nombre_empresa = null
        this.codigo_sucursal = null
        this.telefono_sucursal = null
        this.direccion_sucursal = null
        this.fax_sucursal = null
        this.direccion_afiliado = null
        this.telefono_afiliado = null
        this.ocupacion_afiliado = null
        this.celular_afiliado = null
        this.email_afiliado = null
        this.salario_afiliado = null
        this.fecha_ingreso = null
        this.fecha_salida = null
        this.ubicacion_empresa = null
        // resumen
        this.saldo_impagos = 0
        this.total_impagos = 0
        this.saldo_demanda_judicial = 0
        this.total_demanda_judicial = 0
        this.saldo_cartera_castigada = 0
        this.total_cartera_castigada = 0
        // estados
        this.estado_contribuyente = false
        this.obligado_llevar_contabilidad = false
        this.beneficiado_333 = false
        // listados
        this.actividadesEconomicas = [new Actividad()]
        this.establecimientos = []
        this.operacionesCreditoBancarias = []
        this.operacionesCreditoComerciales = []
        this.saldosPorVencer = [new ItemSaldoPorVencer()]
        this.operacionesCanceladas = [new ItemOperacionCancelada()]
        this.graficas = []
        this.historialCrediticio = this.inicializarHistorialCrediticio()
        this.consultasCliente = this.inicializarConsultasCliente()
        this.morosidades = this.inicializarResumenMorosidades()
        this.vencimientos = this.inicializarResumenVencimientos()
        this.seguros = this.inicializarInformacionSeguros()
        // graficas
        this.score_crediticio = 0
        this.score_sobreendeudamiento = 0
    }

    private inicializarHistorialCrediticio(): ItemHistorialCrediticio[] {
        const listado: ItemHistorialCrediticio[] = []
        const CANTIDAD_MESES = 36
        const meses = obtenerMesesAnteriores(moment(), CANTIDAD_MESES)

        meses.forEach((mes: string) => {
            const item = new ItemHistorialCrediticio()
            item.mes = mes
            listado.push(item)
        })

        return listado
    }

    private inicializarConsultasCliente(): ItemConsultasCliente[] {
        const listado: ItemConsultasCliente[] = []
        const CANTIDAD_MESES = 12
        const meses = obtenerMesesAnteriores(moment(), CANTIDAD_MESES)

        meses.forEach((mes: string) => {
            const item = new ItemConsultasCliente()
            item.mes = mes
            listado.push(item)
        })

        return listado
    }

    private inicializarResumenMorosidades(): ItemMorosidad[] {
        const listado: ItemMorosidad[] = []
        const acreedores = [
            "Sistema Financiero Regulado SB",
            "Entidades Reguladas SEPS",
            "Sector Comercial (INFOCOM)",
            "Total",
        ]

        acreedores.forEach((acreedor: string) => {
            const item = new ItemMorosidad()
            item.acreedor = acreedor
            listado.push(item)
        })

        return listado
    }

    private inicializarResumenVencimientos(): ItemVencimiento[] {
        const listado: ItemVencimiento[] = []
        const acreedores = [
            "Marcimex - telf: 072831991",
            "Marcimex - telf: 072831991",
            "ALFANET - telf: 023731070",
            "Total",
        ]

        acreedores.forEach((acreedor: string) => {
            const item = new ItemVencimiento()
            item.acreedor = acreedor
            listado.push(item)
        })

        return listado
    }

    private inicializarInformacionSeguros(): ItemSeguro[] {
        const listado: ItemSeguro[] = []
        const seguros = ["IESS", "ISSFA", "ISSPOL"]

        seguros.forEach((seguro: string) => {
            const item = new ItemSeguro()
            item.seguro = seguro
            listado.push(item)
        })

        return listado
    }
}
