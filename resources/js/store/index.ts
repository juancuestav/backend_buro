import { createStore } from "vuex"

// modules
import gestorArchivos from "./modules/gestorArchivos"
import authentication from "./modules/authentication"
import menuOptions from "./modules/menuOptions"
import sidebar from "./modules/sidebar"
import cargando from "./modules/cargando"
import pedido from "./modules/pedido"
import chat from "./modules/chat"
import reportes from "./modules/reportes"

export default createStore({
    modules: {
        authentication,
        menuOptions,
        sidebar,
        gestorArchivos,
        cargando,
        pedido,
        chat,
        reportes,
    },
})
