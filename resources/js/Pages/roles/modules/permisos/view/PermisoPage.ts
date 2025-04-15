// Dependencias
import { Link } from "@inertiajs/inertia-vue3"
import { defineComponent, ref } from "vue"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"

// Logica y controladores
import { useNotificaciones } from "@components/toastification/application/notificaciones"
import { PermisoController } from "../infraestructure/PermisoController"
import { endpoints } from "@config/api.config"

export default defineComponent({
    props: {
        todos_permisos: Array,
        permisos_actuales_rol: Array,
        id_rol: Number,
    },
    components: { SidebarLayout, Link },
    setup(props) {
        const listado_permisos: any = ref([])
        const controller = new PermisoController(endpoints.permisos)

        const gestionarPermiso = (permiso: string) => {
            if (listado_permisos.value) {
                const totalElementos = listado_permisos.value.length

                for (let i = 0; i < (totalElementos ?? 0); i++) {
                    const listadoPermisos = listado_permisos.value[i].permisos
                    const totalPermisos = listadoPermisos.length

                    for (let j = 0; j < (totalPermisos ?? 0); j++) {
                        const permisoActual = listadoPermisos[j].permiso

                        if (permisoActual === permiso) {
                            listado_permisos.value[i].permisos[j] = {
                                permiso: permisoActual,
                                activo: !listado_permisos.value[i].permisos[j]
                                    .activo,
                                descripcion:
                                    listado_permisos.value[i].permisos[j]
                                        .descripcion,
                                modulo: listado_permisos.value[i].permisos[j]
                                    .modulo,
                            }
                        }
                    }
                }
            }
        }

        let listadoModulos = props.todos_permisos?.map((permiso: any) =>
            obtenerModulo(permiso)
        )

        listadoModulos = listadoModulos?.filter((item, index) => {
            return listadoModulos?.indexOf(item) === index
        })

        listado_permisos.value = props.todos_permisos?.map((permiso: any) => {
            return {
                permiso: permiso,
                activo: props.permisos_actuales_rol?.includes(permiso),
                descripcion: permiso.replaceAll(".", " ").replaceAll("_", " "),
                modulo: obtenerModulo(permiso),
            }
        })

        listado_permisos.value = listadoModulos?.map((modulo: string) => {
            return {
                modulo: modulo,
                permisos: listado_permisos.value?.filter(
                    (permiso: any) => permiso.modulo === modulo
                ),
            }
        })

        function obtenerModulo(permiso: string) {
            const permisoArray = permiso.split(".")
            const longitudPermisoArray = permisoArray.length
            return permisoArray[longitudPermisoArray - 1]
        }

        const guardarConfiguracion = async () => {
            const { notificarCorrecto, notificarError } = useNotificaciones()

            const mapearPermisos: any = []

            listado_permisos.value.forEach((modulo: any) =>
                mapearPermisos.push(...modulo.permisos)
            )

            const filtrarPermisosActivos = mapearPermisos.filter(
                (permiso: any) => permiso.activo
            )

            const permisosActivos: string[] = filtrarPermisosActivos.map(
                (permiso: any) => permiso.permiso
            )

            try {
                const { response } = await controller.editar({
                    id: props.id_rol,
                    permisos: permisosActivos,
                })
                notificarCorrecto(response.data.mensaje)
            } catch (error: any) {
                notificarError(error.response.data.mensaje)
            }
        }

        return {
            guardarConfiguracion,
            gestionarPermiso,
            listado_permisos,
        }
    },
})
