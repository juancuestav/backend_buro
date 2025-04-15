<template>
    <div class="overflow-auto q-mb-sm">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th
                        v-for="(columna, index) in configuracionColumnas"
                        :key="index"
                    >
                        {{ columna.label }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(fila, index) in elementos" :key="index">
                    <td
                        v-for="(valor, clave) in fila"
                        :key="clave"
                        :class="{
                            'bg-danger-celda':
                                valor === 0 && clave + '' == 'deuda_vencida',
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
import { defineComponent, computed } from "vue"
import { ItemHistorialCrediticio } from "../domain/ItemHistorialCrediticio"

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

<style lang="scss" scoped>
thead {
    background-color: #eee;
}

table {
    border-collapse: collapse;
    width: 100%;

    td,
    th {
        border: 1px solid #000;
    }
}

.bg-danger-celda {
    // background-color: rgba(255, 0, 0, 0.5);
    color: red;
    font-weight: bold;
}
</style>
