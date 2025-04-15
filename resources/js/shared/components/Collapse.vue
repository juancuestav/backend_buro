<template>
    <div
        class="card-body d-flex justify-content-between align-items-center cursor-pointer"
        @click="toggle()"
    >
        <h6 class="fw-bold m-0">{{ titulo }}</h6>
        <span>
            <i v-if="collapsed" class="bi-chevron-up"></i>
            <i v-else class="bi-chevron-down"></i>
        </span>
    </div>

    <div class="collapse" ref="refCollapse">
        <div class="card-body pt-0">
            <slot />
        </div>
    </div>
</template>

<script lang="ts" setup>
import Collapse from "bootstrap/js/src/collapse.js"
import { ref, onMounted } from "vue"
defineProps(["titulo"])

const refCollapse = ref()
let bsCollapse
const collapsed = ref(false)

onMounted(() => {
    bsCollapse = new Collapse(refCollapse.value, {
        toggle: true,
    })
})

function toggle() {
    bsCollapse.toggle()
    collapsed.value = !collapsed.value
    // console.log(bsCollapse)
}
</script>
