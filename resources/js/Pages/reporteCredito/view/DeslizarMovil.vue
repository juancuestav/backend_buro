<template>
    <small v-if="xs" class="fw-bold text-danger d-block"
        >*Deslice la tabla hacia los lados para observar más información</small
    >
</template>

<script lang="ts" setup>
import { computed } from 'vue';

const xs = computed(() => window.screen.width <= 576)
</script>
