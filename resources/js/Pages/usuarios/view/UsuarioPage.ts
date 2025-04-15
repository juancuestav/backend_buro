// Dependencias
import { defineComponent, computed } from "vue"
import { configuracionColumnas } from "../domain/configuracionColumnas.domain"
import { CONFIG_CELULAR } from "@config/numeric.config"

// Componentes
import TabLayout from "@shared/contenedor/view/TabLayout.vue"
import SelectInput from "@components/SelectInput.vue"
import Cleave from "vue-cleave-component"
import { rolesPredeterminados } from "@config/utils.config"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { UsuarioController } from "../infraestructure/UsuarioController"
import { Usuario } from "../domain/Usuario"

export default defineComponent({
    props: {
        roles: Array,
        tipos_identificaciones: Array,
    },
    components: { TabLayout, SelectInput, Cleave },
    setup(props) {
        const mixin = new ContenedorMixin(Usuario, new UsuarioController())
        const { entidad: usuario, disabled, accion } = mixin.useReferencias()

        const ciudadesListado = computed(() => {
            return props.ciudades?.filter(
                (item: any) => item.provincia === usuario.provincia
            )
        })

        return {
            mixin,
            usuario,
            disabled,
            accion,
            ciudadesListado,
            configuracionColumnas,
            CONFIG_CELULAR,
            rolesPredeterminados,
        }
    },
})
