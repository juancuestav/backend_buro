// Dependencias
import { ContextMenuFilasDinamicas } from "@/shared/contenedor/domain/ContextMenuFilasDinamicas"
import { configuracionColumnasActividades } from "../../../domain/configuracionColumnasActividades"
import { configuracionColumnasEstablecimientos } from "../../../domain/configuracionColumnasEstablecimientos"
import { configuracionColumnasOperacionesCredito } from "../../../domain/configuracionColumnasOperacionesCredito"
import { configuracionColumnasHistorialCrediticio } from "../../../domain/configuracionColumnasHistorialCrediticio"
import { configuracionColumnasMorosidades } from "../../../domain/configuracionColumnasMorosidades"
import { configuracionColumnasConsultasCliente } from "../../../domain/configuracionColumnasConsultasCliente"
import { configuracionColumnasUsuario } from "../../../domain/configuracionColumnasUsuario"
import { configuracionColumnasVencimientos } from "../../../domain/configuracionColumnasVencimientos"
import { configuracionColumnasSaldosPorVencer } from "../../../domain/configuracionColumnasSaldosPorVencer"
import { configuracionColumnasOperacionesCanceladas } from "../../../domain/configuracionColumnasOperacionesCanceladas"
import { configuracionColumnasSeguros } from "../../../domain/configuracionColumnasSeguros"
import {
    tiposReportes,
    tiposContribuyente,
} from "@config/reportes_utils.config"
import { defineComponent, ref, onMounted, computed, Ref } from "vue"
import { useStore } from "vuex"
import { Reporte } from "../../../domain/Reporte"
import {
    CONFIG_RUC,
    CONFIG_CELULAR,
    CONFIG_DECIMALES,
} from "@config/numeric.config"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import SelectInput from "@components/SelectInput.vue"
import Listado from "@components/listado/Listado.vue"
import ListadoSeleccionable from "@components/listado/ListadoSeleccionable.vue"
import Collapse from "@components/Collapse.vue"
import { OperacionCredito } from "../../../domain/OperacionCredito"
import { Actividad } from "../../../domain/Actividad"
import { Establecimiento } from "../../../domain/Establecimiento"
import { ItemHistorialCrediticio } from "../../../domain/ItemHistorialCrediticio"
import Cleave from "vue-cleave-component"

import { ItemConsultasCliente } from "../../../domain/ItemConsultasCliente"
import { useOrquestadorUsuario } from "../../../application/OrquestadorSelectorUsuario"
import { ItemMorosidad } from "../../../domain/ItemMorosidad"
import { ItemVencimiento } from "../../../domain/ItemVencimiento"
import { ItemSaldoPorVencer } from "../../../domain/ItemSaldoPorVencer"
import { ItemOperacionCancelada } from "../../../domain/ItemOperacionCancelada"
import { ItemSeguro } from "../../../domain/ItemSeguro"
import { useNotificaciones } from "@/shared/components/toastification/application/notificaciones"
import { getEndpoint } from "@/shared/http/utils"
import { endpoints } from "@/config/api.config"
import axios from "axios"
import { gestionarNotificacionError } from "@/shared/utils"
import { Inertia } from "@inertiajs/inertia"

export default defineComponent({
    components: {
        SidebarLayout,
        SelectInput,
        Listado,
        Collapse,
        ListadoSeleccionable,
        Cleave,
    },
    props: ["reporte", "id", "usuario"],
    setup(props) {
        const reporte: any = ref(new Reporte())
        // Listados
        const actividadesEconomicas: Ref<Actividad[]> = ref([])
        const establecimientos: Ref<Establecimiento[]> = ref([])
        const operacionesCreditoBancarias: Ref<OperacionCredito[]> = ref([])
        const operacionesCreditoComerciales: Ref<OperacionCredito[]> = ref([])
        const historialCrediticio: Ref<ItemHistorialCrediticio[]> = ref([])
        const consultasCliente: Ref<ItemConsultasCliente[]> = ref([])
        const morosidades: Ref<ItemMorosidad[]> = ref([])
        const vencimientos: Ref<ItemVencimiento[]> = ref([])
        const saldosPorVencer: Ref<any[]> = ref([])
        const operacionesCanceladas: Ref<ItemOperacionCancelada[]> = ref([])
        const seguros: Ref<ItemSeguro[]> = ref([])

        const tabIndex = ref(0)

        const store = useStore()

        // ContextMenu
        const contextMenu = new ContextMenuFilasDinamicas(
            actividadesEconomicas,
            Actividad
        ).obtenerContextMenu()

        const contextMenuEstablecimientos = new ContextMenuFilasDinamicas(
            establecimientos,
            Establecimiento
        ).obtenerContextMenu()

        const contextMenuOperacionesCredito = new ContextMenuFilasDinamicas(
            operacionesCreditoBancarias,
            OperacionCredito
        ).obtenerContextMenu()

        const contextMenuOperacionesCreditoComerciales =
            new ContextMenuFilasDinamicas(
                operacionesCreditoComerciales,
                OperacionCredito
            ).obtenerContextMenu()

        const contextMenuVencimientos = new ContextMenuFilasDinamicas(
            vencimientos,
            ItemVencimiento
        ).obtenerContextMenu()

        const contextMenuSaldosPorVencer = new ContextMenuFilasDinamicas(
            saldosPorVencer,
            ItemSaldoPorVencer
        ).obtenerContextMenu()

        const contextMenuOperacionesCanceladas = new ContextMenuFilasDinamicas(
            operacionesCanceladas,
            ItemOperacionCancelada
        ).obtenerContextMenu()

        const contextMenuSeguros = new ContextMenuFilasDinamicas(
            seguros,
            ItemSeguro
        ).obtenerContextMenu()

        // Llenado de listados
        function verificarListados() {
            // actividadesEconomicas
            if (!reporte.value.actividadesEconomicas.length) {
                actividadesEconomicas.value = [
                    ...actividadesEconomicas.value,
                    new Actividad(),
                ]
            } else {
                actividadesEconomicas.value =
                    reporte.value.actividadesEconomicas
            }

            // establecimientos
            if (!reporte.value.establecimientos.length) {
                establecimientos.value = [
                    ...establecimientos.value,
                    new Establecimiento(),
                ]
            } else {
                establecimientos.value = reporte.value.establecimientos
            }

            // Operaciones Credito Bancarias
            if (!reporte.value.operacionesCreditoBancarias.length) {
                operacionesCreditoBancarias.value = [
                    ...operacionesCreditoBancarias.value,
                    new OperacionCredito(),
                ]
            } else {
                operacionesCreditoBancarias.value =
                    reporte.value.operacionesCreditoBancarias
            }

            // Operaciones Credito Comerciales
            if (!reporte.value.operacionesCreditoComerciales.length) {
                operacionesCreditoComerciales.value = [
                    ...operacionesCreditoComerciales.value,
                    new OperacionCredito(),
                ]
            } else {
                operacionesCreditoComerciales.value =
                    reporte.value.operacionesCreditoComerciales
            }

            // Listados con valor predeterminado
            historialCrediticio.value = reporte.value.historialCrediticio
            consultasCliente.value = reporte.value.consultasCliente
            morosidades.value = reporte.value.morosidades
            vencimientos.value = reporte.value.vencimientos
            saldosPorVencer.value = reporte.value.saldosPorVencer
            operacionesCanceladas.value = reporte.value.operacionesCanceladas
            seguros.value = reporte.value.seguros
        }

        onMounted(() => {
            setTimeout(() => verificarListados(), 500)
        })

        async function modificar() {
            const { notificarCorrecto } = useNotificaciones()
            const ruta = getEndpoint(endpoints.consultar_reportes) + props.id

            try {
                const response = await axios.put(ruta, {
                    reporte: reporte.value,
                })
                notificarCorrecto(response.data.mensaje)
            } catch (e) {
                gestionarNotificacionError(e)
            }
        }

        function volver() {
            const ruta = getEndpoint(endpoints.consultar_reportes) + "page"
            Inertia.get(ruta)
        }

        const {
            refListadoSeleccionableUsuario,
            criterioBusquedaUsuario,
            listadoUsuarios,
            listarUsuarios,
            limpiarUsuario,
            seleccionarUsuario,
        } = useOrquestadorUsuario(reporte.value, "usuarios")

        console.log(props.usuario)

		seleccionarUsuario(props.usuario)
        onMounted(() => {
            reporte.value = props.reporte
        })

        return {
            reporte,
            tiposReportes,
            tiposContribuyente,
            modificar,
            volver,
            // agregarGrafico,
            CONFIG_RUC,
            CONFIG_CELULAR,
            CONFIG_DECIMALES,
            tabIndex,
            // Configuracion columnas
            configuracionColumnasActividades,
            configuracionColumnasEstablecimientos,
            configuracionColumnasOperacionesCredito,
            configuracionColumnasHistorialCrediticio,
            configuracionColumnasConsultasCliente,
            configuracionColumnasUsuario,
            configuracionColumnasMorosidades,
            configuracionColumnasVencimientos,
            configuracionColumnasSaldosPorVencer,
            configuracionColumnasOperacionesCanceladas,
            configuracionColumnasSeguros,
            // ContextMenu
            contextMenu,
            contextMenuEstablecimientos,
            contextMenuOperacionesCredito,
            contextMenuOperacionesCreditoComerciales,
            contextMenuVencimientos,
            contextMenuSaldosPorVencer,
            contextMenuOperacionesCanceladas,
            contextMenuSeguros,
            // contextMenuGrafica,
            // Listados
            actividadesEconomicas,
            establecimientos,
            operacionesCreditoBancarias,
            operacionesCreditoComerciales,
            vencimientos,
            saldosPorVencer,
            operacionesCanceladas,
            seguros,
            // graficas,
            historialCrediticio,
            consultasCliente,
            morosidades,
            // orquestador
            refListadoSeleccionableUsuario,
            criterioBusquedaUsuario,
            listadoUsuarios,
            listarUsuarios,
            limpiarUsuario,
            seleccionarUsuario,
        }
    },
})
