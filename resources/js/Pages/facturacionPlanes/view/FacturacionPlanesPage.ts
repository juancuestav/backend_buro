// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent, ref, onMounted } from "vue"
import { EventosTabla } from "../domain/EventosTabla"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Listado from "@components/listado/Listado.vue"

export default defineComponent({
    props: ["facturacion_planes"],
    components: {
        SidebarLayout,
        Listado,
    },
    setup(props) {
        const listado = ref()

        // onMounted(() => (listado.value = props.facturacion_planes))

        setTimeout(() => {
            listado.value = props.facturacion_planes
        }, 500)

        const eventosTabla = new EventosTabla(listado).obtenerBotonesEventos()
        const configuracionColumnasWithEvents = [
            ...eventosTabla,
            ...configuracionColumnas,
        ]

        return {
            listado,
            configuracionColumnasWithEvents,
        }
    },
})
