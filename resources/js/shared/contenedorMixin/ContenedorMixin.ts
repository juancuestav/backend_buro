// Dependencias
import { HooksSimples } from "../contenedor/domain/hooksSimples"
import { Referencias } from "../contenedor/domain/Referencias"
import { Instanciable } from "../entidad/Instanciable"
import { acciones } from "@config/utils.config"
import { reactive, UnwrapRef } from "vue"

// Logica
import { TransaccionController } from "../contenedor/infraestructure/TransaccionController"
import { GestionarListado } from "../contenedor/Application/GestionarListado"
import { gestionarNotificacionError } from "../utils"

// Componentes
import { EstadoCargando } from "@components/cargando/application/EstadoCargando.application"
import { useNotificaciones } from "@components/toastification/application/notificaciones"
import ConfirmationDialog from "@components/confirmationDialog/ConfirmationDialog"

export class ContenedorMixin {
    protected readonly entidad: UnwrapRef<any>
    protected readonly entidad_vacia: UnwrapRef<any>
    protected readonly controller: TransaccionController
    protected readonly referencias: Referencias
    private hooks = new HooksSimples()
    private readonly gestionarListado: GestionarListado
    private readonly estadoCargando: EstadoCargando
    protected readonly notificaciones = useNotificaciones()

    constructor(entidad: Instanciable, controller: TransaccionController) {
        this.entidad = reactive(new entidad())
        this.entidad_vacia = new entidad()
        this.controller = controller
        this.referencias = new Referencias()
        this.gestionarListado = new GestionarListado(this.referencias.listado)
        this.estadoCargando = new EstadoCargando()
    }

    useReferencias(): any {
        return { entidad: this.entidad, ...this.referencias }
    }

    useComportamiento(): any {
        return {
            guardar: this.guardar.bind(this),
            consultar: this.consultar.bind(this),
            editar: this.editar.bind(this),
            eliminar: this.eliminar.bind(this),
            reestablecer: this.reestablecer.bind(this),
            listar: this.listar.bind(this),
        }
    }

    useHooks(): any {
        return {
            onBeforeGuardar: (callback: () => void) =>
                this.hooks.bindHook("onBeforeGuardar", callback),
            onGuardado: (callback: () => void) =>
                this.hooks.bindHook("onGuardado", callback),
            onBeforeConsultar: (callback: () => void) =>
                this.hooks.bindHook("onBeforeConsultar", callback),
            onConsultado: (callback: () => void) =>
                this.hooks.bindHook("onConsultado", callback),
            onBeforeModificar: (callback: () => void) =>
                this.hooks.bindHook("onBeforeModificar", callback),
            onModificado: (callback: () => void) =>
                this.hooks.bindHook("onModificado", callback),
            onReestablecer: (callback: () => void) =>
                this.hooks.bindHook("onReestablecer", callback),
        }
    }

    // Guardar
    private async guardar() {
        this.cargarVista(async () => {
            try {
                this.hooks.onBeforeGuardar()
                const { response, result } = await this.controller.guardar(
                    this.entidad
                )
                this.entidad.hydrate(this.entidad_vacia)
                this.gestionarListado.agregarElemento(result)
                this.notificaciones.notificarCorrecto(response.data.mensaje)
                this.hooks.onGuardado()
            } catch (error: any) {
                gestionarNotificacionError(error)
            }
        })
    }

    // Consultar
    private async consultar(datos: any) {
        if (datos.id === null) {
            return this.notificaciones.notificarAdvertencia(
                "No se ha asignado un id a esta entidad"
            )
        }

        this.cargarVista(async () => {
            try {
                this.hooks.onBeforeConsultar()
                const { result } = await this.controller.consultar(datos.id)
                this.entidad.hydrate(result)
                this.hooks.onConsultado()
                this.referencias.tabIndex.value = 0
            } catch (error: any) {
                gestionarNotificacionError(error)
            }
        })
    }

    // Editar
    private async editar() {
        if (this.entidad.id === null) {
            return this.notificaciones.notificarAdvertencia(
                "No se ha asignado un id a esta entidad"
            )
        }

        this.cargarVista(async () => {
            try {
                this.hooks.onBeforeModificar()
                const { result: modelo, response } =
                    await this.controller.editar(this.entidad)
                await this.entidad.hydrate(this.entidad_vacia)
                this.notificaciones.notificarCorrecto(response.data.mensaje)
                this.gestionarListado.actualizarElemento(modelo)
                this.referencias.accion.value = acciones.nuevo
                this.hooks.onModificado()
            } catch (error: any) {
                gestionarNotificacionError(error)
            }
        })
    }

    // Eliminar
    private async eliminar() {
        ConfirmationDialog.mostrar({
            mensaje: "Esta operación no es reversible.\n¿Desea continuar?",
            btnConfirmText: "Eliminar",
            confirmFunction: async () => {
                this.cargarVista(async () => {
                    try {
                        const { result: mensaje } =
                            await this.controller.eliminar(this.entidad.id)
                        this.notificaciones.notificarCorrecto(mensaje)
                        this.referencias.accion.value = acciones.nuevo
                        this.gestionarListado.eliminarElemento(this.entidad)
                        this.entidad.hydrate(this.entidad_vacia)
                    } catch (error: any) {
                        gestionarNotificacionError(error)
                    }
                })
            },
        })
    }

    // Listar
    private async listar(params?: any) {
        this.cargarVista(async () => {
            try {
                const { result } = await this.controller.listar(params)
                this.referencias.listado.value = result
            } catch (error: any) {
                this.notificaciones.notificarError(
                    "Error al obtener el listado."
                )
            }
        })
    }

    private async reestablecer() {
        this.entidad.hydrate(this.entidad_vacia)
        this.referencias.accion.value = acciones.nuevo
        this.hooks.onReestablecer()
    }

    private async cargarVista(callback: () => Promise<void>): Promise<void> {
        this.estadoCargando.activar()
        await callback()
        this.estadoCargando.desactivar()
    }

    /**
     * Verifica que una entidad haya cambiado sus propiedades.
     * @param entidad entidad a comparar con la copia de un objeto nuevo
     * @returns true, cuando se haya cambiado algun parametro de la entidad.
     */
    /* protected seCambioEntidad(transaccion: UnwrapRef<T>): boolean {
        return compararObjetos(transaccion, this.entidad);
    } */
}
