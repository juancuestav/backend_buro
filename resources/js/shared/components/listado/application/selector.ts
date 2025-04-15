import { sleep } from "@/shared/utils"
import { useNotificaciones } from "../../toastification/application/notificaciones"
import { SelectorController } from "../infraestructure/SelectorController"

export function useSelector(selector: any) {
    const controller = new SelectorController(selector.endpoint)

    const listar = async (criterioBusqueda?: string | null) => {
        const filtros = {
            search: criterioBusqueda,
        }

        if (!criterioBusqueda) delete filtros.search

        const { response } = await controller.listar(filtros)
        const result = response.data.results

        if (result.length === 0) {
            const { notificarAdvertencia } = useNotificaciones()
            await sleep(0)
            notificarAdvertencia("No se encontraron coincidencias")
            return
        }

        // si se obtiene un solo elemento, se auto selecciona
        if (result.length === 1) {
            selector.refListadoSeleccionable.value.seleccionar(result[0])
            return
        }

        // si se obtienen mas, mostrar el listado
        if (result.length > 1) {
            selector.listadoSeleccionable.value = [...result]
            selector.refListadoSeleccionable.value.mostrar()
        }
    }

    const seleccionar = async (id: number) => {
        const { result: seleccionado } = await controller.consultar(id)
        selector.seleccionar(seleccionado)
    }

    return {
        listar,
        seleccionar,
    }
}
