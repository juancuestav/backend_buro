// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent } from "vue"

// Componentes
import ColumnLayout from "@shared/contenedor/view/ColumnLayout.vue"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { RolController } from "../infraestructure/RolController"
import { Rol } from "../domain/Rol"

export default defineComponent({
    props: {
        ciudades: Array,
    },
    components: { ColumnLayout },
    setup() {
        const mixin = new ContenedorMixin(Rol, new RolController())
        const { entidad: rol } = mixin.useReferencias()

        return {
            mixin,
            rol,
            configuracionColumnas,
        }
    },
})
