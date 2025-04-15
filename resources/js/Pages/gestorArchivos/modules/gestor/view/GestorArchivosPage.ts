// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent, computed, reactive } from "vue"
import { findIndexById, formatBytes } from "@shared/utils"
import { useStore } from "vuex"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import CustomDropdown from "@components/customDropdown/view/CustomDropdown.vue"
import FloatingButton from "@components/floatingButton/view/FloatingButton.vue"
import ListadoSeleccionable from "@components/listado/ListadoSeleccionable.vue"

// Logica y controladores
import { useOrquestadorUsuario } from "../application/OrquestadorSelectorUsuario"
import { GestionarArchivos } from "../application/GestionarArchivos"
import { GestionarCarpetas } from "../application/GestionarCarpetas"
import { GestionarNiveles } from "../application/GestionarNiveles"
import { CrearRecursos } from "../application/CrearRecursos"
import { Carpeta } from "../domain/Carpeta"
import { Archivo } from "../domain/Archivo"

export default defineComponent({
    components: {
        SidebarLayout,
        CustomDropdown,
        FloatingButton,
        ListadoSeleccionable,
    },
    setup() {
        const store = useStore()
        const archivos = computed({
            get: () => store.state.gestorArchivos.archivos,
            set: (newValue: Archivo[]) =>
                store.commit("gestorArchivos/SET_ARCHIVOS", newValue),
        })
        const carpetas = computed({
            get: () => store.state.gestorArchivos.carpetas,
            set: (newValue: Carpeta[]) =>
                store.commit("gestorArchivos/SET_CARPETAS", newValue),
        })
        const carpetaPadre = computed({
            get: () => store.state.gestorArchivos.carpetaPadre,
            set: (newValue: number | null) =>
                store.commit("gestorArchivos/SET_CARPETA_PADRE", newValue),
        })
        const carpetaActual = computed({
            get: () => store.state.gestorArchivos.carpetaActual,
            set: (newValue: number | null) =>
                store.commit("gestorArchivos/SET_CARPETA_ACTUAL", newValue),
        })
        const usuarioPropietario = computed({
            get: () => store.state.gestorArchivos.usuarioPropietario,
            set: (newValue: number | null) =>
                store.commit(
                    "gestorArchivos/SET_USUARIO_PROPIETARIO",
                    newValue
                ),
        })

        const mostrarRegresar = computed(
            () => carpetaActual.value != carpetaPadre.value
        )
        const puedeCrearRecursos = computed(() => {
            const usuario = store.state.authentication.usuario
            if (usuario) {
                return (
                    usuario.rol.includes("ADMINISTRADOR") ||
                    usuario.rol.includes("EMPLEADO")
                )
            }
        })
        const carpetaSubirArchivos = reactive(new Carpeta())

        const gestionarNiveles = new GestionarNiveles()
        async function cargarSubnivel(idCarpeta: number | null) {
            try {
                const { subarchivos, subcarpetas, idCarpetaPadre } =
                    await gestionarNiveles.consultarSubnivel(idCarpeta)

                if (idCarpeta && !usuarioPropietario.value) {
                    const index = findIndexById(carpetas.value, idCarpeta)
                    usuarioPropietario.value = carpetas.value[index].usuario
                }
                if (!idCarpeta) usuarioPropietario.value = null

                archivos.value = subarchivos
                carpetas.value = subcarpetas
                carpetaPadre.value = idCarpetaPadre
                carpetaActual.value = idCarpeta
            } catch (error) {
                console.log("Error al obtener el recurso.")
            }
        }

        const { refListadoSeleccionable, listado, listar, seleccionar } =
            useOrquestadorUsuario(carpetaSubirArchivos, "usuarios")

        const gestionarCarpetas = new GestionarCarpetas(
            carpetas,
            listar,
            carpetaSubirArchivos
        )
        const opcionesCarpetas = gestionarCarpetas.opcionesCarpetas

        const gestionarArchivos = new GestionarArchivos(archivos)
        const opcionesArchivos = gestionarArchivos.opcionesArchivos

        const crearRecursos = new CrearRecursos(carpetas)
        const opcionesCrearRecursos = computed(
            () => crearRecursos.opcionesCrearRecursos
        )

        return {
            carpetaPadre,
            carpetaActual,
            archivos,
            carpetas,
            usuarioPropietario,
            mostrarRegresar,
            puedeCrearRecursos,
            cargarSubnivel,
            opcionesCarpetas,
            opcionesArchivos,
            opcionesCrearRecursos,
            extraerExtension: (nombre: string) => nombre.split(".").at(-1),
            formatBytes,
            configuracionColumnas,
            // Orquestador
            refListadoSeleccionable,
            seleccionar,
            listado,
            carpetaSubirArchivos,
        }
    },
})
