import { Archivo } from "@app/gestorArchivos/modules/gestor/domain/Archivo"
import { Carpeta } from "@app/gestorArchivos/modules/gestor/domain/Carpeta"

export default {
    namespaced: true,
    state: () => ({
        subirArchivos: false,
        carpetaPadre: null,
        carpetaActual: null,
        archivos: [],
        carpetas: [],
        usuarioPropietario: null,
    }),
    mutations: {
        SET_SUBIR_ARCHIVOS(state: { subirArchivos: boolean }, value: boolean) {
            state.subirArchivos = value
        },
        SET_ARCHIVOS(state: { archivos: Archivo[] }, value: Archivo[]) {
            state.archivos = value
        },
        SET_CARPETAS(state: { carpetas: Carpeta[] }, value: Carpeta[]) {
            state.carpetas = value
        },
        SET_CARPETA_PADRE(
            state: { carpetaPadre: number | null },
            value: number | null
        ) {
            state.carpetaPadre = value
        },
        SET_CARPETA_ACTUAL(
            state: { carpetaActual: number | null },
            value: number | null
        ) {
            state.carpetaActual = value
        },
        SET_USUARIO_PROPIETARIO(
            state: { usuarioPropietario: string },
            value: string
        ) {
            state.usuarioPropietario = value
        },
    },
}
