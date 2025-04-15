import store from "./store"
import "./bootstrap"
import axios from "axios"
import { baseURL } from "./config/api.config"

import { createInertiaApp } from "@inertiajs/inertia-vue3"
import { createApp, h } from "vue"

// Timeago
import timeago from "vue-timeago3"
import { es } from "date-fns/locale"

// Laravel Echo
import Echo from "laravel-echo"

// Notificaciones
import Toast from "vue-toastification"
import "vue-toastification/dist/index.css"

// Obtener datos de usuario logeado
axios
    .get(baseURL + "admin/user")
    .then((response: any) =>
        store.commit("authentication/SET_USUARIO", response.data)
    )

declare global {
    interface Window {
        Pusher: any
        Echo: any
        axios: any
        Laravel: any
    }
}

// Pusher
window.Pusher = require("pusher-js")
window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
})

// Timeago3
const timeagoOptions = {
    converterOptions: {
        includeSeconds: false,
    },
    locale: es,
}

// Tooltip
import Tooltip from "bootstrap/js/src/tooltip.js"

// Create App
createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        const vueApp = createApp({ render: () => h(app, props) })
        vueApp.use(plugin)
        vueApp.use(store)
        vueApp.use(timeago, timeagoOptions)
        vueApp.use(Toast)

        vueApp.directive("tooltip", {
            mounted(el, binding) {
                new Tooltip(el, {
                    title: binding.value,
                    placement: binding.arg,
                    trigger: "hover",
                })
            },
        })

        vueApp.directive("focus", {
            mounted: (el) => el.focus(),
        })

        vueApp.mount(el)
    },
})
