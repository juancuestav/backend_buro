import { Pedido } from "@/Pages/pedidos/domain/Pedido"
import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"
import axios from "axios"

export default {
    namespaced: true,
    state: () => ({
        pedido: new Pedido(),
        tabIndex: 1,
    }),
    mutations: {
        SET_PEDIDO(state, pedido: Pedido) {
            state.pedido = pedido
        },
        SET_TABINDEX(state, tabIndex: number) {
            state.tabIndex = tabIndex
        },
    },
    actions: {
        async consultar({ commit }, id: number) {
            const ruta = getEndpoint(endpoints.pedidos) + id
            const response = await axios.get(ruta)
            commit("SET_PEDIDO", response.data.modelo)
        },
    },
}
