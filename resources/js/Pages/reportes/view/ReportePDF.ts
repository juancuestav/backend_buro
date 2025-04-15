// Dependencias
import { configuracionColumnasOperacionesCanceladas } from "../domain/configuracionColumnasOperacionesCanceladas"
import { configuracionColumnasHistorialCrediticio } from "../domain/configuracionColumnasHistorialCrediticio"
import { configuracionColumnasOperacionesCredito } from "../domain/configuracionColumnasOperacionesCredito"
import { configuracionColumnasEstablecimientos } from "../domain/configuracionColumnasEstablecimientos"
import { configuracionColumnasConsultasCliente } from "../domain/configuracionColumnasConsultasCliente"
import { configuracionColumnasSaldosPorVencer } from "../domain/configuracionColumnasSaldosPorVencer"
import { configuracionColumnasVencimientos } from "../domain/configuracionColumnasVencimientos"
import { configuracionColumnasActividades } from "../domain/configuracionColumnasActividades"
import { configuracionColumnasMorosidades } from "../domain/configuracionColumnasMorosidades"
import { configuracionColumnasSeguros } from "../domain/configuracionColumnasSeguros"
import { computed, defineComponent, ref } from "vue"
import { useStore } from "vuex"

// Componentes
import TableViewHistorialCrediticio from "@components/listado/TableViewHistorialCrediticio.vue"
import ReportePreview from "@/Pages/reportes/modules/previewReporteCliente/view/ReportePreview.vue"
import TableView from "@components/listado/TableView.vue"
import Contador from "@components/Contador.vue"
import html2pdf from "html2pdf.js"

// Logica y controladores
import { getEndpoint } from "@/shared/http/utils"
import { endpoints } from "@/config/api.config"
import axios from "axios"
import { useNotificaciones } from "@/shared/components/toastification/application/notificaciones"
import { gestionarNotificacionError } from "@/shared/utils"

export default defineComponent({
    components: {
        TableView,
        TableViewHistorialCrediticio,
        Contador,
        ReportePreview,
    },
    setup() {
        const store = useStore()
        const reporte = computed(() => store.state.reportes.reporte)
        const actividadesEconomicas: any = ref()
        const establecimientos: any = ref()
        const totalEstablecimientos = computed(() => {
            if (establecimientos.value) {
                return establecimientos.value.length
            }
            return 0
        })

        const fechaActual = new Date().toLocaleDateString()

        function volver() {
            store.dispatch("reportes/mostrarFormulario")
        }

        const refPDF = ref()
        function imprimir() {
            const contenido = refPDF.value
            html2pdf()
                .set({
                    margin: 0,
                    filename: "reporte.pdf",
                    image: {
                        type: "jpeg",
                        quality: 0.98,
                    },
                    html2canvas: {
                        scale: 3,
                        letterRendering: true,
                    },
                    jsPDF: {
                        unit: "in",
                        format: "a4",
                        orientation: "portrait",
                    },
                })
                .from(contenido)
                .save()
                .catch((err) => console.log(err))
        }

        async function guardar() {
            const { notificarCorrecto, notificarError } = useNotificaciones()
            const ruta = getEndpoint(endpoints.reportes)

            try {
                const response = await axios.post(ruta, {
                    reporte: reporte.value,
                })
                notificarCorrecto(response.data.mensaje)
            } catch (e: any) {
                notificarError(e.response.data.mensaje)
            }
        }

        return {
            refPDF,
            reporte,
            fechaActual,
            guardar,
            totalEstablecimientos,
            volver,
            imprimir,
            // tipoGrafico,
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
            // Listados
            actividadesEconomicas,
            establecimientos,
        }
    },
})
