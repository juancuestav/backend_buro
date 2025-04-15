import { Reporte } from "@/Pages/reportes/domain/Reporte"

export default {
    namespaced: true,
    state: () => ({
        mostrarFormulario: true,
        reporte: new Reporte(),
    }),
    mutations: {
        SET_MOSTRAR_FORMULARIO(
            state: { mostrarFormulario: boolean },
            valor: boolean
        ) {
            state.mostrarFormulario = valor
        },
        SET_REPORTE(state: { reporte: boolean }, valor: boolean) {
            state.reporte = valor
        },
    },
    actions: {
        mostrarFormulario({ commit }: any) {
            commit("SET_MOSTRAR_FORMULARIO", true)
        },
        mostrarReportePDF({ commit }: any) {
            commit("SET_MOSTRAR_FORMULARIO", false)
        },
    },
}
