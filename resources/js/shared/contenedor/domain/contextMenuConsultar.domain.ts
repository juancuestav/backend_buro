import { ContenedorMixin } from "../../contenedorMixin/ContenedorMixin"
import { acciones } from "../../../config/utils.config"
import { Ref } from "vue"

export class ContextMenuConsultar {
    private mixin: ContenedorMixin
    private accion: Ref

    constructor(mixin: ContenedorMixin, accion: Ref) {
        this.mixin = mixin
        this.accion = accion
    }

    private obtenerAccionesTabla() {
        const { consultar } = this.mixin.useComportamiento()
        return {
            consultar: (datos: any) => {
                this.accion.value = acciones.consultar
                consultar(datos)
            },
        }
    }

    obtenerContextMenu() {
        const accionesTabla = this.obtenerAccionesTabla()

        return [
            {
                label: `<span class="px-2"><i class="bi-eye me-2"></i>Consultar</span>`,
                action: function (e, row) {
                    accionesTabla.consultar(row._row.data)
                },
            },
        ]
    }
}
