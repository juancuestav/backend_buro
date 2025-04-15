// Dependencias
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { defineComponent, computed, reactive, watch, ref } from "vue"

// Componentes
import BotonesSeleccionables from "@components/BotonesSeleccionables.vue"
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Listado from "@components/listado/Listado.vue"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { Notificacion } from "../domain/Notificacion.domain"
import { NotificacionController } from "../infraestructure/NotificacionController"
import { EventosTabla } from "../domain/eventosTabla"

export default defineComponent({
    components: {
        SidebarLayout,
        Listado,
        BotonesSeleccionables,
    },
    setup() {
        const mixin = new ContenedorMixin(
            Notificacion,
            new NotificacionController()
        )
        const { listado } = mixin.useReferencias()
        const { listar } = mixin.useComportamiento()

        listar()

        // Botones seleccionables
        const opcionesNotificaciones = reactive({
            nuevos: true,
            todos: false,
        })

        const filtrosNotificaciones = computed({
            get: () => [
                {
                    value: "nuevos",
                    descripcion: "Nuevas notificaciones",
                    estado: opcionesNotificaciones.nuevos,
                },
                {
                    value: "todos",
                    descripcion: "Todos",
                    estado: opcionesNotificaciones.todos,
                },
            ],
            set: (opcion: any) => {
                cambiarTipo(opcion.value)
                configurarColumnas(opcion.value)
                listar({ tipo: opcion.value })
            },
        })

        const tipos = ["nuevos", "todos"]

        const cambiarTipo = (value: any) => {
            opcionesNotificaciones[value] = true
            tipos.forEach((tipo) => {
                if (tipo !== value) {
                    opcionesNotificaciones[tipo] = false
                }
            })
        }

        const columnas: any = ref([])

        function configurarColumnas(tipoNotificacion: string) {
            console.log(tipoNotificacion)
            columnas.value.splice(
                0,
                columnas.value.length,
                ...new EventosTabla(listado).obtenerBotonesEventos(
                    tipoNotificacion
                ),
                ...configuracionColumnas
            )

            console.log(columnas.value)
        }

        configurarColumnas("nuevos")

        return {
            listado,
            columnas,
            filtrosNotificaciones,
        }
    },
})
