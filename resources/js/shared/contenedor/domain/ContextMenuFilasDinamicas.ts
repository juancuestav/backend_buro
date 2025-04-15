import { Instanciable } from "@shared/entidad/Instanciable"
import { Ref } from "vue"

export class ContextMenuFilasDinamicas {
    private listado: Ref<any[]>
    private entidad: Instanciable

    constructor(listado: Ref<any[]>, entidad: Instanciable) {
        this.listado = listado
        this.entidad = entidad
    }

    obtenerContextMenu() {
        const listado = this.listado
        const entidad = this.entidad

        return [
            {
                label: `<span class="px-2"><i class="bi-arrow-bar-up me-2"></i>Agregar fila arriba</span>`,
                action: function (e, row) {
                    const fila = new entidad()

                    const indice = row._row.component.getPosition()
                    listado.value.splice(indice, 0, fila)
                    listado.value = [...listado.value]
                },
            },
            {
                label: `<span class="px-2"><i class="bi-arrow-bar-down me-2"></i>Agregar fila debajo</span>`,
                action: function (e, row) {
                    const fila = new entidad()

                    const indice = row._row.component.getPosition()
                    listado.value.splice(indice + 1, 0, fila)
                    listado.value = [...listado.value]
                },
            },
            {
                label: `<span class="px-2"><i class="bi-trash me-2"></i>Eliminar fila</span>`,
                action: function (e, row) {
                    const indice = row._row.component.getPosition()
                    listado.value.splice(indice, 1)
                    listado.value = [...listado.value]
                },
            },
        ]
    }
}
