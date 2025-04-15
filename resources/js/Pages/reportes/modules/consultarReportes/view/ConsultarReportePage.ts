// Dependencias
import { configuracionColumnasUsuario } from "@/Pages/reportes/domain/configuracionColumnasUsuario"
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent, ref } from "vue"
import axios from "axios"

// Componentes
import ListadoSeleccionable from "@components/listado/ListadoSeleccionable.vue"
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Listado from "@components/listado/Listado.vue"

// Logica y controladores
import { useOrquestadorUsuario } from "../application/OrquestadorSelectorUsuario"
import { ItemMiReporte } from "../domain/ItemMiReporte"
import { EventosTabla } from "../domain/EventosTabla"
import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"
import * as moment from "moment"
import { sleep } from "@/shared/utils"
import { useNotificaciones } from "@/shared/components/toastification/application/notificaciones"

export default defineComponent({
    components: { SidebarLayout, Listado, ListadoSeleccionable },
    setup() {
        const listado: any = ref([])
        const idUsuario = ref(null)

        async function obtenerListado() {
            const params = "?usuario=" + idUsuario.value
            const ruta = getEndpoint(endpoints.consultar_reportes) + params
            const response = await axios.get(ruta)

            const results = response.data.results

            const { notificarAdvertencia } = useNotificaciones()
            await sleep(0)
            notificarAdvertencia("No se encontraron coincidencias")

            const data: any = []
            for (let i = 0; i < results.length; i++) {
                const item = new ItemMiReporte()
                item.id = results[i].id
                item.nombre =
                    "Reporte " +
                    moment(results[i].created_at).format("YYYY-MM-DD") +
                    "-" +
                    results[i].id
                item.ruta =
                    getEndpoint(endpoints.consultar_reportes) + results[i].id
                data.push(item)
            }

            listado.value = [...data]
        }

        const {
            refListadoSeleccionableUsuario,
            criterioBusquedaUsuario,
            listadoUsuarios,
            listarUsuarios,
            limpiarUsuario,
            seleccionarUsuario,
        } = useOrquestadorUsuario(idUsuario, "usuarios")

        const eventosTabla = new EventosTabla(listado).obtenerBotonesEventos()
        const configuracionColumnasWithEvents = [
            ...eventosTabla,
            ...configuracionColumnas,
        ]

        return {
            configuracionColumnasWithEvents,
            configuracionColumnasUsuario,
            listado,
            obtenerListado,
            // Orquestador
            refListadoSeleccionableUsuario,
            criterioBusquedaUsuario,
            listadoUsuarios,
            listarUsuarios,
            limpiarUsuario,
            seleccionarUsuario,
        }
    },
})
