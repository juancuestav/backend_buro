import { computed, defineComponent } from "vue"

// componentes
import CardLayout from "@shared/contenedor/view/CardLayout.vue"
import SelectorImagen from "@components/SelectorImagen.vue"

// logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { Popup } from "../domain/Popup"
import { PopupController } from "../infraestructure/PopupController"

export default defineComponent({
    components: { CardLayout, SelectorImagen },
    setup() {
        const mixin = new ContenedorMixin(Popup, new PopupController())

        const { entidad: publicidad } = mixin.useReferencias()

        const setBase64 = (file: File) => {
            if (file !== null && file !== undefined) {
                const reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onload = () => (publicidad.imagen = reader.result)
            } else {
                publicidad.imagen = file
            }
        }

        const imagenEntidad = computed(() => {
            if (
                publicidad.imagen !== null &&
                typeof publicidad.imagen === "string" &&
                !publicidad.imagen.includes(";base64,")
            ) {
                return publicidad.imagen
            }
        })

        function resetearNuevaPestana() {
            publicidad.url_destino ? null : (publicidad.nueva_pestana = false)
        }

        return {
            mixin,
            publicidad,
            setBase64,
            imagenEntidad,
            resetearNuevaPestana,
        }
    },
})
