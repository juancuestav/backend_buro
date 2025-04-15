// Dependencias
import { computed, defineComponent, ref } from "vue"

// Componentes
import ReportePreview from "@/Pages/reportes/modules/previewReporteCliente/view/ReportePreview.vue"
import TableView from "@components/listado/TableView.vue"
import TableViewHistorialCrediticio from "@components/listado/TableViewHistorialCrediticio.vue"
import Contador from "@components/Contador.vue"
import html2pdf from "html2pdf.js"

import { Reporte } from "@/Pages/reportes/domain/Reporte"
import { Inertia } from "@inertiajs/inertia"
import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"

export default defineComponent({
    props: {
        reporte: {
            type: Object as () => Reporte,
        },
    },
    components: {
        TableView,
        TableViewHistorialCrediticio,
        Contador,
        ReportePreview,
    },
    setup(props) {
        const reporte = computed(() => props.reporte)
        const actividadesEconomicas: any = ref()
        const establecimientos: any = ref()

        const fechaActual = new Date().toLocaleDateString()

        const totalEstablecimientos = computed(() => {
            if (establecimientos.value) {
                return establecimientos.value.length
            }
            return 0
        })

        function inicializarTablas() {
            actividadesEconomicas.value = [
                ...reporte.value.actividadesEconomicas,
            ]
            establecimientos.value = [...reporte.value.establecimientos]
        }
        setTimeout(inicializarTablas, 500)

        function volver() {
            const ruta = getEndpoint(endpoints.consultar_reportes) + "page"
            Inertia.get(ruta)
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

        return {
            refPDF,
            reporte,
            fechaActual,
            totalEstablecimientos,
            volver,
            imprimir,
            // Listados
            actividadesEconomicas,
            establecimientos,
        }
    },
})
