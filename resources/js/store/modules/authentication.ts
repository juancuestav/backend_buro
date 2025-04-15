export default {
    namespaced: true,
    state: () => ({
        usuario: null,
    }),
    mutations: {
        SET_USUARIO(state: { usuario: any }, value: any) {
            state.usuario = value
        },
    },
}
