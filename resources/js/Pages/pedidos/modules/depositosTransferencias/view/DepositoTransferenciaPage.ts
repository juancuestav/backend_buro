// Dependencias
import { CONFIG_DECIMALES } from "@config/numeric.config"
import { tiposTransferencias } from "@config/utils.config"
import { gestionarNotificacionError } from "@shared/utils"
import { Inertia } from "@inertiajs/inertia"
import { useStore } from "vuex"
import {
    defineComponent,
    computed,
    onMounted,
    reactive,
    ref,
    watchEffect,
} from "vue"

// Componentes
import ConfirmationDialog from "@components/confirmationDialog/ConfirmationDialog"
import SelectorImagen from "@components/SelectorImagen.vue"
import SelectInput from "@components/SelectInput.vue"
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import { Link } from "@inertiajs/inertia-vue3"
import Cleave from "vue-cleave-component"

// Logica y controladores
import { DepositoTransferenciaController } from "../infraestructure/DepositoTransferenciaController"
import { DepositoTransferencia } from "../domain/DepositoTransferencia"
import { getEndpoint } from "@/shared/http/utils"
import { endpoints } from "@/config/api.config"

export default defineComponent({
    props: {
        modelo: Object,
        entidades_financieras: Array,
    },
    components: {
        SidebarLayout,
        Link,
        Cleave,
        SelectorImagen,
        SelectInput,
    },
    setup(props) {
        const entidad = reactive(new DepositoTransferencia())
        const controller = new DepositoTransferenciaController()

        const store = useStore()
        const disabled = ref(false)

        onMounted(() => {
            entidad.hydrate(props.modelo)

            if (props.modelo?.id != null) {
                disabled.value = true
            }
        })

        const guardarPedido = () => {
            ConfirmationDialog.mostrar({
                mensaje: "Esta operación no es reversible.\n¿Desea continuar?",
                btnConfirmText: "Registrar pago",
                confirmFunction: async () => {
                    try {
                        entidad.pedido = entidad.pedido
                        await controller.guardar(entidad)

                        consultarPedido()
                    } catch (error: any) {
                        gestionarNotificacionError(error)
                    }
                },
            })
        }

        const consultarPedido = async () => {
            await store.dispatch("pedido/consultar", entidad.pedido)
            const ruta = getEndpoint(endpoints.pedidos) + "page"
            Inertia.get(ruta)
        }

        const setBase64 = (file: File) => {
            if (file !== null && file !== undefined) {
                const reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onload = () => (entidad.imagen = reader.result)
            } else {
                entidad.imagen = file
            }
        }

        const imagenEntidad = computed(() => {
            if (
                entidad.imagen !== null &&
                typeof entidad.imagen === "string" &&
                !entidad.imagen.includes(";base64,")
            ) {
                return entidad.imagen
            }
        })

        watchEffect(() => {
            if (entidad.es_deposito) {
                entidad.tipo_transferencia = null
            }
        })

        return {
            entidad,
            disabled,
            guardarPedido,
            consultarPedido,
            CONFIG_DECIMALES,
            setBase64,
            imagenEntidad,
            tiposTransferencias,
        }
    },
})
