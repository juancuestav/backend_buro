// Dependencias
import { defineComponent, reactive } from "vue"
import {
    CONFIG_DECIMALES,
    CONFIG_PORCENTAJE,
    CONFIG_CELULAR,
} from "@config/numeric.config"
import { estados } from "@config/utils.config"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Cleave from "vue-cleave-component"
import SelectInput from "@components/SelectInput.vue"

// Logica y controladores
import { Configuracion } from "../domain/Configuracion"
import { ConfiguracionController } from "../infraestructure/ConfiguracionController"
import { useNotificaciones } from "@/shared/components/toastification/application/notificaciones"

export default defineComponent({
    props: {
        configuracion_actual: Object,
    },
    components: {
        SidebarLayout,
        Cleave,
        SelectInput,
    },
    setup(props) {
        const configuracion = reactive(new Configuracion())
        const controller = new ConfiguracionController()
        const notificaciones = useNotificaciones()

        configuracion.hydrate(props.configuracion_actual)

        const editar = async (rol: any) => {
            try {
                const { response } = await controller.guardar(configuracion)
                notificaciones.notificarCorrecto(response.data.mensaje)
            } catch (error: any) {
                notificaciones.notificarError(error.response.data.mensaje)
            }
        }

        return {
            configuracion,
            editar,
            CONFIG_DECIMALES,
            CONFIG_PORCENTAJE,
            CONFIG_CELULAR,
            estados,
        }
    },
})
