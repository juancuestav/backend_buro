<template>
    <div class="text-center">
        <div class="q-mb-sm">{{ titulo }}</div>
        <h2>
            {{ numero }}
        </h2>
        <!-- <q-knob
            v-model="valorFijo"
            disable
            show-value
            :step="1"
            size="90px"
            :color="color"
            track-color="grey-3"
            :class="`text-${color}`"
        >
            <template #default
                >{{ numero
                }}<small v-if="decimales" class="q-pt-xs">.00</small></template
            >
        </q-knob> -->
    </div>
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, ref } from "vue"

export default defineComponent({
    props: {
        titulo: {
            type: String,
            required: true,
        },
        valor: {
            type: Number,
            required: true,
        },
        repetir: {
            type: Boolean,
            default: false,
        },
        decimales: {
            type: Boolean,
            default: false,
        },
    },
    setup(props) {
        const valorFijo = ref(props.valor)
        const numero = ref(0)

        let cantidad = 0

        onMounted(() => {
            let tiempo = setInterval(() => {
                numero.value = cantidad
                if (cantidad === props.valor) {
                    // clearInterval(tiempo)
                    cantidad = 1
                }
                cantidad += 1
            }, 60)
        })

        const color = computed(() => obtenerColor())

        function obtenerColor() {
            if (props.valor <= 399) {
                return "red-13"
            } else if (props.valor >= 400 && props.valor <= 849) {
                return "amber-6"
            } else if (props.valor >= 850) {
                return "lime"
            }
        }

        return {
            valorFijo,
            numero,
            color,
        }
    },
})
</script>
