// Dependencias
import { defineComponent } from "vue"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { CambiarContrasenaController } from "../infraestructure/CambiarContrasenaController"
import { CambiarContrasena } from "../domain/CambiarContrasena"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"

export default defineComponent({
    components: {
        SidebarLayout,
    },
    setup() {
        const mixin = new ContenedorMixin(
            CambiarContrasena,
            new CambiarContrasenaController()
        )
        const { entidad: cambiarContrasena } = mixin.useReferencias()
        const { guardar } = mixin.useComportamiento()
        return {
            cambiarContrasena,
            guardar,
        }
    },
})
