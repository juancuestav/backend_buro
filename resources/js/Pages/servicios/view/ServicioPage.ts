// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas.domain"
import { estadosProductoListado } from "@config/utils.config"
import { CONFIG_DECIMALES } from "@config/numeric.config"
import { defineComponent, watchEffect } from "vue"

// Componentes
import TabLayout from "@shared/contenedor/view/TabLayout.vue"
import SelectorImagen from "@components/SelectorImagen.vue"
import SelectInput from "@components/SelectInput.vue"
import Cleave from "vue-cleave-component"
import { VueEditor } from "vue3-editor"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { ServicioController } from "../infraestructure/ServicioController"
import { Servicio } from "../domain/Servicio"

export default defineComponent({
    props: {
        categorias: Array,
    },
    components: {
        TabLayout,
        VueEditor,
        Cleave,
        SelectInput,
        SelectorImagen,
    },
    setup(props) {
        const mixin = new ContenedorMixin(Servicio, new ServicioController())
        const { entidad: producto, disabled, accion } = mixin.useReferencias()
        const { onBeforeGuardar, onBeforeModificar } = mixin.useHooks()

        const setBase64 = (file: File) => {
            if (file !== null && file !== undefined) {
                const reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onload = () => (producto.imagen = reader.result)
            } else {
                producto.imagen = file
            }
        }

        watchEffect(() => {
            if (producto.es_plan) producto.categoria = null
        })

        onBeforeGuardar(() => {
            if (producto.url_video) {
                const video = producto.url_video.replace("watch?v=", "embed/")
                producto.url_video = video
            }
        })

        onBeforeModificar(() => {
            if (producto.url_video) {
                const video = producto.url_video.replace("watch?v=", "embed/")
                producto.url_video = video
            }
        })

        return {
            mixin,
            disabled,
            producto,
            accion,
            estadosProductoListado,
            CONFIG_DECIMALES,
            configuracionColumnas,
            setBase64,
        }
    },
})
