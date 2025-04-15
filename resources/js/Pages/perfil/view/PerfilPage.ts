// Dependencias
import { defineComponent, onMounted, reactive } from "vue"
import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"
import axios from "axios"

// Componentes
import { useNotificaciones } from "@components/toastification/application/notificaciones"
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import SelectInput from "@components/SelectInput.vue"

// Logica y controladores
import { Perfil } from "../domain/Perfil"
import { gestionarNotificacionError } from "@shared/utils"
import { ApiError } from "@/shared/http/ApiError"

export default defineComponent({
    props: {
        usuario: Object,
        tipos_identificaciones: Array,
    },
    components: {
        SidebarLayout,
        SelectInput,
    },
    setup(props) {
        const perfil = reactive(new Perfil())
        const { notificarCorrecto } = useNotificaciones()
        onMounted(() => perfil.hydrate(props.usuario))

        async function actualizar() {
            try {
                const response = await axios.post(
                    getEndpoint(endpoints.perfil),
                    perfil
                )
                notificarCorrecto(response.data.mensaje)
            } catch (e: any) {
                gestionarNotificacionError(new ApiError(e))
            }
        }

        return {
            perfil,
            actualizar,
        }
    },
})
