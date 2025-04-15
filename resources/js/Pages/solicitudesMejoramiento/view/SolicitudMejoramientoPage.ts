// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas.domain"
import { CONFIG_CELULAR, CONFIG_PUNTUACION } from "@config/numeric.config"
import { estadosMejoramiento } from "@config/utils.config"
import { defineComponent } from "vue"

// Componentes
import TabLayout from "@shared/contenedor/view/TabLayout.vue"
import { rolesPredeterminados } from "@config/utils.config"
import SelectInput from "@components/SelectInput.vue"
import Cleave from "vue-cleave-component"

// Logica y controladores
import { SolicitudMejoramientoController } from "../infraestructure/SolicitudMejoramientoController"
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { Mejoramiento } from "../domain/Mejoramiento"

export default defineComponent({
    props: {
        solicitudes: Array,
    },
    components: { TabLayout, SelectInput, Cleave },
    setup() {
        const mixin = new ContenedorMixin(
            Mejoramiento,
            new SolicitudMejoramientoController()
        )
        const {
            entidad: mejoramiento,
            disabled,
            accion,
        } = mixin.useReferencias()

        return {
            mixin,
            mejoramiento,
            disabled,
            accion,
            configuracionColumnas,
            CONFIG_CELULAR,
            CONFIG_PUNTUACION,
            rolesPredeterminados,
            estadosMejoramiento,
        }
    },
})
