// Dependencias
import { defineComponent } from "vue"
import { tiposEntidadesFinancieras } from "@config/utils.config"
import { configuracionColumnas } from "../domain/configuracionColumnas.domain"

// componentes
import ColumnLayout from "@shared/contenedor/view/ColumnLayout.vue"
import SelectInput from "@components/SelectInput.vue"

// logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { EntidadFinanciera } from "../domain/EntidadFinanciera"
import { EntidadFinancieraController } from "../infraestructure/EntidadFinancieraController"

export default defineComponent({
    components: { ColumnLayout, SelectInput },
    setup() {
        const mixin = new ContenedorMixin(
            EntidadFinanciera,
            new EntidadFinancieraController()
        )
        const { entidad: entidadFinanciera, disabled } = mixin.useReferencias()

        return {
            mixin,
            entidadFinanciera,
            disabled,
            tiposEntidadesFinancieras,
            configuracionColumnas,
        }
    },
})
