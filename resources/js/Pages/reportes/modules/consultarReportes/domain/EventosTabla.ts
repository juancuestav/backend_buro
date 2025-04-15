import { useNotificaciones } from "@components/toastification/application/notificaciones"
import { getEndpoint } from "@shared/http/utils"
import { ItemMiReporte } from "./ItemMiReporte"
import { endpoints } from "@config/api.config"
import { findIndexById } from "@/shared/utils"
import { Inertia } from "@inertiajs/inertia"
import axios from "axios"
import { Ref } from "vue"

// Botones
const btnQuitar = function (cell, formatterParams) {
    return `<span class="btn btn-light btn-sm"><i class='bi-trash'></i></span>`
}
const renderConsultarReporte = function (cell, formatterParams) {
    return `<span class="btn btn-light btn-sm"><i class='bi-eye'></i></span>`
}
const renderEditarReporte = function (cell, formatterParams) {
    return `<span class="btn btn-light btn-sm"><i class='bi-pencil-square'></i></span>`
}

export class EventosTabla {
    private listado: Ref<ItemMiReporte[]>

    constructor(listado: Ref<ItemMiReporte[]>) {
        this.listado = listado
    }

    private eliminarItemListado(index: number) {
        console.log(this.listado)
        this.listado.value.splice(index, 1)
        this.listado.value = [...this.listado.value]
    }

    private async eliminar(id: number) {
        const { notificarCorrecto, notificarError } = useNotificaciones()
        const ruta = getEndpoint(endpoints.consultar_reportes) + id

        try {
            const response = await axios.delete(ruta)
            notificarCorrecto(response.data.mensaje)
        } catch (error: any) {
            notificarError(error.response.data.mensaje)
        }
    }

    obtenerBotonesEventos() {
        const eliminarItem = (index: number) => this.eliminarItemListado(index)
        const listado = this.listado
        const eliminar = this.eliminar

        return [
            {
                formatter: renderConsultarReporte,
                hozAlign: "center",
                headerSort: false,
                vertAlign: "middle",
                responsive: 0,
                cellClick: function (e, cell) {
                    const data = cell.getRow().getData()
                    Inertia.get(data.ruta)
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
                    Inertia.get(data.ruta + "/edit")
                },
            },
            {
                formatter: btnQuitar,
                hozAlign: "center",
                maxWidth: 100,
                headerSort: false,
                cellClick: function (e, cell) {
                    const data = cell.getRow().getData()
                    const index = findIndexById(listado.value, data.id)
                    if (index !== null) {
                        eliminarItem(index)
                        eliminar(data.id)
                    }
                },
            },
        ]
    }
}
