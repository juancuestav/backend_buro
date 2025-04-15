// Dependencias
import { defineComponent, onMounted } from "vue"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import * as moment from "moment"

export default defineComponent({
    props: {
        celular: {
            type: String,
        },
    },
    components: {
        SidebarLayout,
    },
    setup(props) {
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
                link.classList.add("btn", "btn-success", "text-white", "mb-4")

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
            //
        }
    },
})
