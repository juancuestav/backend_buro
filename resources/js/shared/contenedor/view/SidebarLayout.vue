<template>
    <sidebar></sidebar>
    <navbar></navbar>

    <!-- Cargando -->
    <transition name="fade">
        <cargando></cargando>
    </transition>

    <!-- Chat -->
    <transition name="bounce">
        <chat></chat>
    </transition>

    <div :style="{ 'margin-left': marginLeftPage }">
        <main class="px-4 py-2">
            <slot />
        </main>
    </div>
</template>

<script lang="ts">
import Sidebar from "@components/theNavbar/TheNavbar.vue"
import Navbar from "@components/theSidebar/TheSidebar.vue"
import Cargando from "@components/cargando/view/Cargando.vue"
import Chat from "@components/chat/view/Chat.vue"

import { defineComponent } from "vue"
import useSidebar from "@/shared/components/theSidebar/composables/useSidebar"

export default defineComponent({
    components: { Sidebar, Navbar, Cargando, Chat },
    setup() {
        const { marginLeftPage } = useSidebar()
        return { marginLeftPage }
    },
})
</script>
