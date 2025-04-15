import { Usuario } from "@/Pages/usuarios/domain/Usuario"
import { useSelector } from "@/shared/components/listado/application/selector"
import { Hidratable } from "@/shared/entidad/Hidratable"
import { endpoints } from "@config/api.config"
import { Ref, ref } from "vue"

export function useOrquestadorUsuario(
    idUsuario: Ref<number | null>,
    endpoint: keyof typeof endpoints
) {
    const refListadoSeleccionable = ref() // referencia para llamar a los metodos del listado
    const listado: Ref<Hidratable[]> = ref([]) // listado resultado de búsqueda
    const criterioBusqueda = ref() //: UnwrapRef<string | null> = null;

    const singleSelector = {
        refListadoSeleccionable: refListadoSeleccionable,
        listadoSeleccionable: listado,
        endpoint: endpoint,
        limpiar: () => {
            idUsuario.value = null
            criterioBusqueda.value = null
        },
        seleccionar: (usuario: Usuario) => {
            idUsuario.value = usuario.id
            criterioBusqueda.value = usuario.identificacion
        },
    }

    const selector = useSelector(singleSelector)

    const listar = () => selector.listar(criterioBusqueda.value)

    const limpiar = () => singleSelector.limpiar()

    const seleccionar = (id: number) => selector.seleccionar(id)

    return {
        refListadoSeleccionableUsuario: refListadoSeleccionable,
        listadoUsuarios: listado,
        listarUsuarios: listar,
        limpiarUsuario: limpiar,
        seleccionarUsuario: seleccionar,
        criterioBusquedaUsuario: criterioBusqueda,
    }
}
