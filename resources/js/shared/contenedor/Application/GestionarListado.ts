import { Ref } from "vue";

export class GestionarListado {
    private listado: Ref<any[]>;

    constructor(listado: Ref<any[]>) {
        this.listado = listado;
    }

    obtenerIndiceElemento(id: number | null): number {
        return this.listado.value.findIndex(
            (elemento: any) => elemento.id === id
        );
    }

    agregarElemento(entidad: any): void {
        this.listado.value = [...this.listado.value, entidad];
    }

    eliminarElemento(entidad: any): void {
        const indice = this.obtenerIndiceElemento(entidad.id);
        if (indice >= 0) {
            this.listado.value.splice(indice, 1);
            this.listado.value = [...this.listado.value];
        }
    }

    actualizarElemento(entidad: any): void {
        const indice = this.obtenerIndiceElemento(entidad.id);
        if (indice >= 0) {
            this.listado.value.splice(indice, 1, entidad);
            this.listado.value = [...this.listado.value];
        }
    }
}
