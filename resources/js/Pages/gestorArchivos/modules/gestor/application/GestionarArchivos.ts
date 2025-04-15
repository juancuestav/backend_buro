// Dependencias
import { descargarArchivo, getEndpoint } from "@shared/http/utils"
import { baseURL, endpoints } from "@config/api.config"
import { Ref, computed, watch } from "vue"
import can from "@/mixins/Permissions"
import axios from "axios"

// Componentes
import ConfirmationDialog from "@components/confirmationDialog/ConfirmationDialog"

// Logica y controladores
import { OpcionDropdown } from "@components/customDropdown/domain/OpcionDropdown"
import { Archivo } from "../domain/Archivo"
import { useStore } from "vuex"

export class GestionarArchivos {
    opcionesArchivos: OpcionDropdown[]
    archivos: Ref<Archivo[]>

    constructor(archivos: Ref<Archivo[]>) {
        this.archivos = archivos
        const store = useStore()

        const carpetaActual = computed(
            () => (store as any).state.gestorArchivos.carpetaActual
        )

        this.opcionesArchivos = this.generarOpciones()

        watch(carpetaActual, () => {
            const opciones = this.generarOpciones()
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
                    const ruta = getEndpoint(endpoints.archivos) + idEntidad
                    const response = await axios.put(ruta, data)
                    console.log(response.data.mensaje)
                    const index = this.archivos.value.findIndex(
                        (archivo: Archivo) => archivo.id === idEntidad
                    )

                    this.archivos.value[index].nombre = response.data.nombre
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
                    const ruta = getEndpoint(endpoints.archivos) + idEntidad
                    const response = await axios.delete(ruta)
                    console.log(response.data.mensaje)
                    const index = this.archivos.value.findIndex(
                        (archivo: Archivo) => archivo.id === idEntidad
                    )
                    this.archivos.value.splice(index, 1)
                } catch (error: any) {
                    console.log("No se pudo eliminar")
                }
            },
        })
    }

    private async descargar(idEntidad: number) {
        try {
            const index = this.archivos.value.findIndex(
                (archivo: Archivo) => archivo.id === idEntidad
            )
            const archivo = this.archivos.value[index]
            const response = await axios({
                url: baseURL + "admin" + archivo.ruta,
                method: "GET",
                responseType: "blob",
            })
            console.log(response.data)
            const extension = archivo.ruta?.split(".").at(-1) ?? ""
            const mimeType = response.data.type
            descargarArchivo(
                response.data,
                archivo.nombre ?? "ar",
                mimeType,
                extension
            )
        } catch (error: any) {
            console.log("No se pudo descargar")
        }
    }

    private generarOpciones(): OpcionDropdown[] {
        const cambiarNombre = new OpcionDropdown(
            "Cambiar nombre",
            (id: number) => this.cambiarNombre(id)
        )
        const eliminar = new OpcionDropdown("Eliminar", (id: number) =>
            this.eliminar(id)
        )
        const descargar = new OpcionDropdown("Descargar", (id: number) =>
            this.descargar(id)
        )

        if (can("puede.gestionar.recursos")) {
            return [cambiarNombre, eliminar, descargar]
        } else {
            return [descargar]
        }
    }

    private establecerOpciones(listado: OpcionDropdown[]) {
        const totalItems = this.opcionesArchivos.length
        this.opcionesArchivos.splice(0, totalItems, ...listado)
    }
}
