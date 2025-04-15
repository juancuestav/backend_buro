// Dependencias
import { configuracionColumnasUsuario } from "@/Pages/reportes/domain/configuracionColumnasUsuario"
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent, ref } from "vue"
import axios from "axios"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Listado from "@components/listado/Listado.vue"

// Logica y controladores
import { EventosTabla } from "../domain/EventosTabla"
import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"
import * as moment from "moment"
import { sleep } from "@/shared/utils"
import { useNotificaciones } from "@/shared/components/toastification/application/notificaciones"

export default defineComponent({
    props: ['notificaciones'],
    components: { SidebarLayout, Listado },
    setup() {
        const listado: any = ref([])
        const idUsuario = ref(null)
        const mensaje = ref()
        const nuevoMensaje = ref(false)

        const {notificarCorrecto, notificarError} = useNotificaciones()

        async function obtenerListado() {
            const ruta = getEndpoint(endpoints.notificaciones_cliente)
            const response = await axios.get(ruta)

            const results = response.data.results

            listado.value = [...results]
        }

        const eventosTabla = new EventosTabla(listado).obtenerBotonesEventos()
        const configuracionColumnasWithEvents = [
            ...eventosTabla,
            ...configuracionColumnas,
        ]

        obtenerListado()

        async function enviar() {
            const ruta = getEndpoint(endpoints.notificaciones_cliente)

            try{
                const response = await axios.post(ruta, {mensaje: mensaje.value})
                notificarCorrecto(response.data.mensaje)
                listado.value = [...listado.value, {
                    fecha: new Date().toLocaleDateString(),
                    mensaje: mensaje.value,
                }]
                mensaje.value = null
            } catch(e: any) {
                notificarError("No se pudo enviar mensaje")
            }

        }

        return {
            configuracionColumnasWithEvents,
            configuracionColumnasUsuario,
            listado,
            obtenerListado,
            mensaje,
            nuevoMensaje,
            enviar,
        }
    },
})
