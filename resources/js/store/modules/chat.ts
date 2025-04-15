import { Notificacion } from "@/Pages/notificaciones/domain/Notificacion.domain"
import { Chat } from "@components/chat/domain/Chat"

export default {
    namespaced: true,
    state: () => ({
        mostrar: false,
        notificacion: null,
        chat: new Chat(),
    }),
    mutations: {
        SET_MOSTRAR(state: { mostrar: boolean }, valor: boolean) {
            state.mostrar = valor
        },
        SET_NOTIFICACION(
            state: { notificacion: Notificacion },
            valor: Notificacion
        ) {
            state.notificacion = valor
        },
        SET_CHAT(state: { chat: Chat }, valor: Chat) {
            state.chat = valor
        },
    },
    actions: {
        mostrarChat({ commit }: any) {
            commit("SET_MOSTRAR", true)
        },
        ocultarChat({ commit }: any) {
            commit("SET_MOSTRAR", false)
        },
        resetChat({ commit }: any) {
            commit("SET_CHAT", new Chat())
        },
    },
}
