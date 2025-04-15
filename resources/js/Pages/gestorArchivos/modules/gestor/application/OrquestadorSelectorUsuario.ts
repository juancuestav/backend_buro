import { Ref, ref } from "vue"
import { useSelector } from "./SelectorUsuarios"
import { Hidratable } from "@/shared/entidad/Hidratable"
import { endpoints } from "@/config/api.config"
import { Carpeta } from "../domain/Carpeta"
import { Usuario } from "../domain/Usuario"

export function useOrquestadorUsuario(
    entidad: Carpeta,
    endpoint: keyof typeof endpoints
) {
    const refListadoSeleccionable = ref() // referencia para llamar a los metodos del listado
    const listado: Ref<Hidratable[]> = ref([]) // listado de catalogos a renderizar
    const criterioBusqueda = ref() //: UnwrapRef<string | null> = null;

    const singleSelector = {
        refListadoSeleccionable: refListadoSeleccionable,
        listadoSeleccionable: listado,
        endpoint: endpoint,
        seleccionar: (usuario: Usuario) => {
            entidad.usuario = usuario.id
        },
    }

    const selector = useSelector(singleSelector)

    const listar = () => selector.listar(criterioBusqueda.value)

    const seleccionar = (id: number) => selector.seleccionar(id)

    return {
        refListadoSeleccionable,
        listado,
        listar,
        seleccionar,
        criterioBusqueda,
    }
}
