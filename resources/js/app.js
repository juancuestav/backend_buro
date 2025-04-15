import "./bootstrap"
import "./animaciones"

export const notificarCorrecto = (message) => {
    toastr["success"](message, "Correcto", {
        closeButton: true,
        positionClass: "toast-bottom-right",
    })
}

export const notificarError = (message) => {
    toastr["error"](message, "Error", {
        closeButton: true,
        positionClass: "toast-bottom-right",
    })
}

export const notificarAdvertencia = (message) => {
    toastr["warning"](message, "Advertencia", {
        closeButton: true,
        positionClass: "toast-bottom-right",
    })
}

window.notificaciones = {
    notificarCorrecto,
    notificarError,
    notificarAdvertencia,
}

import { createApp } from "vue";

const app = createApp({
    /* root component options */
    // el: "#app",
});

import ReporteCredito from '../js/Pages/reporteCredito/view/ReporteCreditoPage.vue'

app.component("reporte-credito", ReporteCredito);
app.mount("#app");
