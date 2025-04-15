<template>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th
                        v-for="(columna, index) in configuracionColumnas"
                        :key="index"
                    >
                        {{ columna.title }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(fila, index) in elementos"
                    :key="index"
                    :class="{
                        'bg-danger-celda': parseFloat(fila.deuda_vencida) === 0,
                    }"
                >
                    <td
                        v-for="(valor, clave) in fila"
                        :key="clave"
                        :class="{
                            'bg-danger-celda':
                                pintarColumna && clave + '' == 'deuda_vencida',
                        }"
                    >
                        {{
                            parseFloat(valor) + "" === "NaN"
                                ? valor
                                : parseFloat(valor).toFixed(2)
                        }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import { ItemHistorialCrediticio } from "@/Pages/reportes/domain/ItemHistorialCrediticio"
import { defineComponent, computed } from "vue"

export default defineComponent({
    props: ["configuracionColumnas", "elementos"],
    setup(props) {
        const pintarColumna = computed(() =>
            props.elementos.some(
                (item: ItemHistorialCrediticio) => item.deuda_vencida === 0
            )
        )

        return { pintarColumna }
    },
})
</script>

<style scoped>
thead {
    background-color: #eee;

    /* background: rgb(173, 140, 32);
    background: linear-gradient(
        90deg,
        rgba(173, 140, 32, 1) 0%,
        rgba(238, 234, 121, 1) 18%,
        rgba(173, 140, 32, 1) 55%,
        rgba(238, 234, 121, 1) 100%
    ); */
}

.bg-danger-celda {
    background-color: rgba(255, 0, 0, 0.5);
}
</style>
