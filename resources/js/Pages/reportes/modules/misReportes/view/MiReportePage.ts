// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent, ref, onMounted, computed } from "vue"
import { useStore } from "vuex"
import axios from "axios"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Listado from "@components/listado/Listado.vue"

// Logica y controladores
import { getEndpoint } from "@/shared/http/utils"
import { endpoints } from "@/config/api.config"
import { ItemMiReporte } from "../domain/ItemMiReporte"
import * as moment from "moment"
import { rolesPredeterminados } from "@/config/utils.config"

export default defineComponent({
    components: { SidebarLayout, Listado },
    setup() {
        const listado: any = ref([])

        const store = useStore()
        const puedeExportar = computed(() => {
            const usuario = (store as any).state.authentication.usuario
            if (usuario)
                return !usuario.rol.includes(rolesPredeterminados.CLIENTE)
        })

        onMounted(() => {
            obtenerListado()
        })

        async function obtenerListado() {
            const ruta = getEndpoint(endpoints.mis_reportes)
            const response = await axios.get(ruta)

            const results = response.data.results
            const data: any = []
            for (let i = 0; i < results.length; i++) {
                const item = new ItemMiReporte()
                item.id = results[i].id
                item.nombre =
                    "Reporte " +
                    moment(results[i].created_at).format("YYYY-MM-DD")
                item.ruta = getEndpoint(endpoints.mis_reportes) + results[i].id
                data.push(item)
            }

            listado.value = [...data]
        }
        return {
            configuracionColumnas,
            listado,
            puedeExportar,
        }
    },
})
