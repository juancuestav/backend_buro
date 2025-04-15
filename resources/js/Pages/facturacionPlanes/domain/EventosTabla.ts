import { FacturacionPlan } from "./FacturacionPlan"
import { Ref } from "vue"
import { getEndpoint } from "@/shared/http/utils"
import { endpoints } from "@/config/api.config"
import axios from "axios"
import { useNotificaciones } from "@/shared/components/toastification/application/notificaciones"
import * as moment from "moment"

const renderConsultarReporte = function (cell, formatterParams) {
    return `<span class="btn btn-success btn-sm text-white"><i class='bi-arrow-up-circle me-2'></i>Pagado</span>`
}
const renderEditarReporte = function (cell, formatterParams) {
    return `<span class="btn btn-danger btn-sm"><i class='bi-arrow-down-circle me-2'></i>No pagado</span>`
}

export class EventosTabla {
    private listado: Ref<FacturacionPlan[]>

    constructor(listado: Ref<FacturacionPlan[]>) {
        this.listado = listado
    }

    async pagado(id: number, indice: number) {
        const { notificarCorrecto } = useNotificaciones()
        const ruta = getEndpoint(endpoints.facturacion_planes) + id
        try {
            const response = await axios.put(ruta)
            notificarCorrecto(response.data.mensaje)
            this.listado.value[indice].pagado = true
            this.listado.value[indice].fecha_pago = moment().format("YYYY-MM-DD")
            this.listado.value[indice].proximo_pago = moment().add(1, "month").format("YYYY-MM-DD")

            this.listado.value = [...this.listado.value]
        } catch (e) {}
    }

    async noPagado(id: number, indice: number) {
        const { notificarCorrecto } = useNotificaciones()
        const ruta = getEndpoint(endpoints.facturacion_planes) + id
        try {
            const response = await axios.delete(ruta)
            notificarCorrecto(response.data.mensaje)
            this.listado.value[indice].pagado = false
            this.listado.value = [...this.listado.value]
        } catch (e) {}
    }

    obtenerBotonesEventos() {
        const listado = this.listado
        const pagado = (id: number, indice: number) => this.pagado(id, indice)
        const noPagado = (id: number, indice: number) =>
            this.noPagado(id, indice)

        return [
            {
                formatter: renderConsultarReporte,
                hozAlign: "center",
                headerSort: false,
                vertAlign: "middle",
                responsive: 0,
                cellClick: function (e, cell) {
                    const data = cell.getRow().getData()
                    const indice = cell.getRow().getPosition()
                    pagado(data.id, indice)
                },
            },
            {
                formatter: renderEditarReporte,
                hozAlign: "center",
                headerSort: false,
                vertAlign: "middle",
                responsive: 0,
                cellClick: function (e, cell) {
                    const data = cell.getRow().getData()
                    const indice = cell.getRow().getPosition()
                    noPagado(data.id, indice)
                },
            },
        ]
    }
}
