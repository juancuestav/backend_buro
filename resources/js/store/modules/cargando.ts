export default {
    namespaced: true,
    state: () => ({
        cargando: false,
    }),
    mutations: {
        GESTIONAR_CARGANDO(state: { cargando: boolean }, valor: boolean) {
            state.cargando = valor
        },
    },
    actions: {
        activarCargando({ commit }: any) {
            commit("GESTIONAR_CARGANDO", true)
        },
        desactivarCargando({ commit }: any) {
            commit("GESTIONAR_CARGANDO", false)
        },
    },
}
