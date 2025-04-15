// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent, ref } from "vue"
// import { EventosTabla } from "../domain/EventosTabla"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Listado from "@components/listado/Listado.vue"

export default defineComponent({
    props: ["marketings"],
    components: {
        SidebarLayout,
        Listado,
    },
    setup(props) {
        const listado = ref()

        // onMounted(() => (listado.value = props.facturacion_planes))

        setTimeout(() => {
            listado.value = props.marketings
        }, 500)

        /* const eventosTabla = new EventosTabla(listado).obtenerBotonesEventos()
        const configuracionColumnasWithEvents = [
            ...eventosTabla,
            ...configuracionColumnas,
        ] */

        return {
            listado,
            configuracionColumnas,
        }
    },
})
