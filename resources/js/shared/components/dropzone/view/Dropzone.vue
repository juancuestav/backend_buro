<template>
    <div
        :data-active="active"
        @dragenter.prevent="setActive"
        @dragover.prevent="setActive"
        @dragleave.prevent="setInactive"
        @drop.prevent="onDrop"
    >
        <!-- share state with the scoped slot -->
        <slot :dropZoneActive="active"></slot>
    </div>
</template>

<script lang="ts" setup>
import { onMounted, onUnmounted, ref } from "vue"
const emit = defineEmits(["files-dropped"])

// Create `active` state and manage it with functions
let active = ref(false)
let inActiveTimeout

function setActive() {
    active.value = true
	clearTimeout(inActiveTimeout) // clear the timeout
}

function setInactive() {
    // wrap it in a `setTimeout`
    inActiveTimeout = setTimeout(() => {
        active.value = false
    }, 50)
}

function onDrop(e: any) {
    setInactive()
    emit("files-dropped", [...e.dataTransfer.files])
}

function preventDefaults(e) {
    e.preventDefault()
}

const events = ["dragenter", "dragover", "dragleave", "drop"]

onMounted(() => {
    events.forEach((eventName) => {
        document.body.addEventListener(eventName, preventDefaults)
    })
})

onUnmounted(() => {
    events.forEach((eventName) => {
        document.body.removeEventListener(eventName, preventDefaults)
    })
})
</script>
