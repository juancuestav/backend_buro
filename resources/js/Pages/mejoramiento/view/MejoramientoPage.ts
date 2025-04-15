// Dependencias
import { configuracionColumnasUsuario } from "@/Pages/reportes/domain/configuracionColumnasUsuario"
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent, ref, reactive } from "vue"
import { estadosSI_NO, puntuaciones } from "@config/utils.config"
import { CONFIG_PUNTUACION } from "@config/numeric.config"
import axios from "axios"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Listado from "@components/listado/Listado.vue"
import SelectInput from "@components/SelectInput.vue"
import CardMejoramiento from "./CardMejoramiento.vue"
import Cleave from "vue-cleave-component"

// Logica y controladores
import { EventosTabla } from "../domain/EventosTabla"
import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"
import * as moment from "moment"
import { gestionarNotificacionError, sleep } from "@/shared/utils"
import { useNotificaciones } from "@/shared/components/toastification/application/notificaciones"
import { Mejoramiento } from "../domain/Mejoramiento"
import { ApiError } from "@/shared/http/ApiError"

export default defineComponent({
    props: {
        solicitud: Object,
        cantidadSolicitudesEnviadas: Number,
    },
    components: {
        SidebarLayout,
        Listado,
        SelectInput,
        CardMejoramiento,
        Cleave,
    },
    setup(props) {
        const listado: any = ref([])
        const solicitudData = ref()
        const mejoramiento = reactive(new Mejoramiento())
        mejoramiento.fecha = new Date().toLocaleDateString()
        const nuevoMensaje = ref(false)
        const solicitudesEnviadas = ref()

        const { notificarCorrecto } = useNotificaciones()
        solicitudData.value = props.solicitud
        solicitudesEnviadas.value = props.cantidadSolicitudesEnviadas

        /* async function obtenerListado() {
            const ruta = getEndpoint(endpoints.notificaciones_cliente)
            const response = await axios.get(ruta)

            const results = response.data.results

            listado.value = [...results]
        } */

        const eventosTabla = new EventosTabla(listado).obtenerBotonesEventos()
        const configuracionColumnasWithEvents = [
            ...eventosTabla,
            ...configuracionColumnas,
        ]

        // obtenerListado()

        async function enviar() {
            const ruta = getEndpoint(endpoints.mejoramiento)

            try {
                const response = await axios.post(ruta, mejoramiento)
                notificarCorrecto(response.data.mensaje)
                /* listado.value = [...listado.value, {
                    fecha: new Date().toLocaleDateString(),
                    mensaje: mensaje.value,
                }] */
                // mensaje.value = null
                solicitudData.value = response.data.modelo
                mejoramiento.hydrate(new Mejoramiento())
                mejoramiento.fecha = new Date().toLocaleDateString()
                solicitudesEnviadas.value = solicitudesEnviadas.value + 1
            } catch (e: any) {
                gestionarNotificacionError(new ApiError(e))
            }
        }

        return {
            configuracionColumnasWithEvents,
            configuracionColumnasUsuario,
            solicitudesEnviadas,
            listado,
            mejoramiento,
            nuevoMensaje,
            enviar,
            solicitudData,
            estadosSI_NO,
            puntuaciones,
            CONFIG_PUNTUACION,
        }
    },
})
