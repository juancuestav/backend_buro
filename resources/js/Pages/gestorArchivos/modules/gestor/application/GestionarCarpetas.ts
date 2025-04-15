// Dependencias
import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"
import { Ref, computed, watch } from "vue"
import store from "@/store"
import axios from "axios"
import can from "@/mixins/Permissions"

// Componentes
import ConfirmationDialog from "@components/confirmationDialog/ConfirmationDialog"

// Logica y controladores
import { OpcionDropdown } from "@components/customDropdown/domain/OpcionDropdown"
import { Carpeta } from "../domain/Carpeta"

export class GestionarCarpetas {
    opcionesCarpetas: OpcionDropdown[]
    carpetas: Ref<Carpeta[]>
    carpetaSeleccionada: Carpeta
    listar: () => void

    constructor(
        carpetas: Ref<Carpeta[]>,
        listar: () => void,
        carpetaSeleccionada: Carpeta
    ) {
        this.carpetaSeleccionada = carpetaSeleccionada
        this.carpetas = carpetas
        this.listar = listar

        const carpetaActual = computed(
            () => (store as any).state.gestorArchivos.carpetaActual
        )

        this.opcionesCarpetas = this.generarOpciones(carpetaActual)

        watch(carpetaActual, () => {
            const opciones = this.generarOpciones(carpetaActual)
            this.establecerOpciones(opciones)
        })
    }

    private cambiarNombre(idEntidad: number) {
        ConfirmationDialog.mostrar({
            mensaje: "¿Está seguro de cambiar el nombre?",
            enableInput: true,
            placeholder: "Nuevo nombre",
            confirmFunction: async (inputValue?: string) => {
                try {
                    const data = { nombre: inputValue }
                    const ruta = getEndpoint(endpoints.carpetas) + idEntidad
                    const response = await axios.put(ruta, data)
                    console.log(response.data.mensaje)
                    const index = this.carpetas.value.findIndex(
                        (carpeta: Carpeta) => carpeta.id === idEntidad
                    )

                    this.carpetas.value[index].nombre = response.data.nombre
                } catch (error: any) {
                    console.log("No se pudo cambiar nombre")
                }
            },
        })
    }

    private eliminar(idEntidad: number) {
        ConfirmationDialog.mostrar({
            mensaje: "Esta operación no es reversible.\n¿Desea continuar?",
            btnConfirmText: "Eliminar",
            confirmFunction: async () => {
                try {
                    const ruta = getEndpoint(endpoints.carpetas) + idEntidad
                    const response = await axios.delete(ruta)
                    const index = this.carpetas.value.findIndex(
                        (carpeta: Carpeta) => carpeta.id === idEntidad
                    )
                    this.carpetas.value.splice(index, 1)
                } catch (error: any) {
                    console.log("No se pudo eliminar")
                }
            },
        })
    }

    private seleccionarUsuario(idCarpeta: number, listar: () => void) {
        const usuario = computed(() => this.carpetaSeleccionada.usuario)
        const stop = watch(usuario, () => {
            if (usuario.value) {
                this.asignarUsuario(idCarpeta, usuario.value)
            }
            stop()
        })
        listar()
    }

    private async asignarUsuario(idCarpeta: number, usuario: number) {
        try {
            const data = { usuario }
            const ruta =
                getEndpoint(endpoints.carpetas) + idCarpeta + "/asignar-usuario"
            const response = await axios.post(ruta, data)

            const index = this.carpetas.value.findIndex(
                (carpeta: Carpeta) => carpeta.id === idCarpeta
            )

            this.carpetas.value[index].usuario = response.data.usuario
        } catch (error: any) {
            console.log("No se pudo cambiar nombre")
        }
    }

    private generarOpciones(carpetaActual: Ref): OpcionDropdown[] {
        const cambiarNombre = new OpcionDropdown(
            "Cambiar nombre",
            (idCarpeta: number) => this.cambiarNombre(idCarpeta)
        )
        const eliminar = new OpcionDropdown("Eliminar", (idCarpeta: number) =>
            this.eliminar(idCarpeta)
        )
        const asignarUsuario = new OpcionDropdown(
            "Asignar usuario",
            (idCarpeta: number) =>
                this.seleccionarUsuario(idCarpeta, this.listar)
        )

        if (can("puede.gestionar.recursos")) {
            if (!carpetaActual.value)
                return [cambiarNombre, eliminar, asignarUsuario]
            return [cambiarNombre, eliminar]
        } else {
            return []
        }
    }

    private establecerOpciones(listado: OpcionDropdown[]) {
        const totalItems = this.opcionesCarpetas.length
        this.opcionesCarpetas.splice(0, totalItems, ...listado)
    }
}
