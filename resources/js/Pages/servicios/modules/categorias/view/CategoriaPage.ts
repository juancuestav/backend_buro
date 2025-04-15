// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent } from "vue"

// Componentes
import ColumnLayout from "@shared/contenedor/view/ColumnLayout.vue"

// Logica y controladores
import { CategoriaController } from "../infraestructure/CategoriaController"
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { Categoria } from "../domain/Categoria"

export default defineComponent({
    components: { ColumnLayout },
    setup() {
        const mixin = new ContenedorMixin(Categoria, new CategoriaController())
        const { entidad: categoria, disabled } = mixin.useReferencias()

        return {
            mixin,
            categoria,
            disabled,
            configuracionColumnas,
        }
    },
})
