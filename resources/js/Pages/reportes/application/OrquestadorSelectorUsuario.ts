import { Usuario } from "@/Pages/usuarios/domain/Usuario"
import { useSelector } from "@/shared/components/listado/application/selector"
import { Hidratable } from "@/shared/entidad/Hidratable"
import { endpoints } from "@config/api.config"
import * as moment from "moment"
import { Ref, ref } from "vue"
import { Reporte } from "../domain/Reporte"

export function useOrquestadorUsuario(
    entidad: Reporte,
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
            entidad.usuario = null
            criterioBusqueda.value = null
        },
        seleccionar: (usuario: Usuario) => {
            entidad.usuario = usuario.id
            entidad.nombres_cliente =
                usuario.name + " " + (usuario.apellidos ?? "")
            entidad.direccion_cliente = usuario.direccion
            entidad.celular_cliente = usuario.celular
            entidad.correo_cliente = usuario.email
            entidad.identificacion_cliente = usuario.identificacion
            entidad.ruc_cliente = usuario.identificacion
            entidad.edad_cliente = parseInt(usuario.edad ?? "0")
                /*parseInt(moment().format("YYYY")) -
                parseInt(moment(usuario.fecha_nacimiento).format("YYYY"))*/

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
