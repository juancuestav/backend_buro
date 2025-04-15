import { computed, Ref } from "vue";
import { useStore } from "vuex";

export class EstadoCargando {
    public estaCargando: Ref<boolean>;
    public store = useStore();

    constructor() {
        this.estaCargando = computed(() => this.store.state.cargando.cargando);
    }

    activar() {
        this.store.dispatch("cargando/activarCargando");
    }

    desactivar() {
        this.store.dispatch("cargando/desactivarCargando");
    }
}
