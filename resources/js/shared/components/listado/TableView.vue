<template>
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th
                        v-for="(columna, index) in configuracionColumnas"
                        :key="index"
                        class="mini-texto"
                    >
                        {{ columna.title }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(fila, index) in elementos" :key="index">
                    <td v-for="(celda, index) in fila" :key="index" class="mini-texto">
                        {{ celda }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import { defineComponent } from "vue"

export default defineComponent({
    props: ["configuracionColumnas", "elementos"],
    setup() {},
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

.mini-texto {
    font-size: 10px;
}
</style>
