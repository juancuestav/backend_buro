// Dependencias
import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"
import { Ref, watch, computed } from "vue"
import axios from "axios"
import store from "@/store"

// Componentes
import ConfirmationDialog from "@components/confirmationDialog/ConfirmationDialog"

// Logica y controladores
import { OpcionFloatingButton } from "@components/floatingButton/domain/OpcionFloatingButton"
import { Carpeta } from "../domain/Carpeta"

export class CrearRecursos {
    opcionesCrearRecursos: OpcionFloatingButton[]
    carpetas: Ref<Carpeta[]>
    copia: OpcionFloatingButton[]

    constructor(carpetas: Ref<Carpeta[]>) {
        this.carpetas = carpetas
        this.opcionesCrearRecursos = [
            new OpcionFloatingButton(
                "Crear carpeta",
                "bi-folder-plus",
                (carpetaActual?: number) => this.crearCarpeta(carpetaActual)
            ),
            new OpcionFloatingButton(
                "Subir archivos",
                "bi-upload",
                (idEntidad?: number) => this.subirArchivos(idEntidad)
            ),
        ]
        this.copia = this.opcionesCrearRecursos.slice()

        const estadoCarpetaActual = computed(
            () => (store as any).state.gestorArchivos.carpetaActual
        )

        this.filtrarOpciones(estadoCarpetaActual)

        watch(estadoCarpetaActual, () => {
            this.filtrarOpciones(estadoCarpetaActual)
        })
    }

    private filtrarOpciones(estadoCarpetaActual: Ref) {
		console.log(estadoCarpetaActual.value)
        if (!estadoCarpetaActual.value) {
            this.opcionesCrearRecursos.splice(
                0,
                this.opcionesCrearRecursos.length,
                ...this.opcionesCrearRecursos.filter(
                    (opcion: OpcionFloatingButton) =>
                        opcion.titulo !== "Subir archivos"
                )
            )
        } else {
            this.opcionesCrearRecursos.splice(
                0,
                this.opcionesCrearRecursos.length,
                ...this.copia
            )
        }
    }

    private crearCarpeta(carpetaActual?: number) {
        ConfirmationDialog.mostrar({
            mensaje: "Ingrese el nombre de la carpeta",
            btnConfirmText: "Crear",
            enableInput: true,
            placeholder: "Nombre",
            confirmFunction: async (inputValue?: string) => {
                try {
                    const data = {
                        nombre: inputValue,
                        id_carpeta_padre: carpetaActual,
                    }
                    const ruta = getEndpoint(endpoints.carpetas)
                    const response = await axios.post(ruta, data)
                    console.log(response.data.mensaje)
                    const carpeta = response.data.modelo
                    this.carpetas.value.push(carpeta)
                } catch (error: any) {
                    console.log("No se pudo cambiar nombre")
                }
            },
        })
    }

    private subirArchivos(carpetaActual?: number) {
        store.commit("gestorArchivos/SET_SUBIR_ARCHIVOS", true)
        store.commit("gestorArchivos/SET_CARPETA_ACTUAL", carpetaActual)
    }
}
