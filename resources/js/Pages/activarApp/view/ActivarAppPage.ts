// Dependencias
import { defineComponent, ref, onMounted } from "vue"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import * as moment from "moment"

export default defineComponent({
    props: ["planes", "facturacion", "celular"],
    components: {
        SidebarLayout,
    },
    setup(props) {
        let fechaProximaFacturacion
        const verPlanes = ref(false)

        if (props.facturacion != null) {
            const fecha = moment(props.facturacion.proximo_pago)
            fechaProximaFacturacion = fecha.format("DD/MM/YYYY")
        }

        onMounted(() => {
            const botonWhatsapp = document.getElementById("boton-whatsapp")

            if (botonWhatsapp) {
                const link = document.createElement("a")
                const celular = props.celular
                const phone = "593" + celular.substring(1, celular.length)

                if (window.innerWidth < 768) {
                    link.href = `https://api.whatsapp.com/send?phone=${phone}`
                } else {
                    link.href = `https://web.whatsapp.com/send?phone=${phone}`
                }

                link.target = "_blank"
                link.classList.add(
                    "btn",
                    "btn-success",
                    "text-white",
                    "mb-4",
                    "p-2"
                )
                link.style.borderRadius = "20px"
                link.style.boxShadow =
                    "0px 10px 80px -10px rgba(44, 254, 92, 0.5)"

                // icono
                const i = document.createElement("i")
                i.classList.add("bi-whatsapp", "me-2")

                const texto = document.createElement("span")
                texto.innerHTML = "¿Necesitas ayuda?"

                link.appendChild(i)
                link.appendChild(texto)

                botonWhatsapp.appendChild(link)
            }
        })

        return {
            fechaProximaFacturacion,
            verPlanes,
        }
    },
})
