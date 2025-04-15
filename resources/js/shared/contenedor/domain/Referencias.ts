import { computed, ComputedRef, Ref, ref } from "vue"
import { acciones } from "../../../config/utils.config"

export class Referencias {
    tabIndex: Ref
    listado: Ref<any[]>
    accion: Ref<string>
    disabled: ComputedRef<boolean>

    constructor() {
        this.tabIndex = ref(0)
        this.listado = ref([])
        this.accion = ref(acciones.nuevo)
        // boolean para desactivar la edicion en formularios
        this.disabled = computed(() => {
            return [acciones.eliminar, acciones.consultar].includes(
                this.accion.value
            )
        })
    }
}
