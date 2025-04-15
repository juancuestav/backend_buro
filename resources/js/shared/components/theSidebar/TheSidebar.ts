// Dependencias
import { defineComponent } from "vue"
import { useStore } from "vuex"
import useSidebar from "./composables/useSidebar"

// Componentes
import SidebarMenuItem from "./theSidebarMenuItem/TheSidebarMenuItem.vue"

export default defineComponent({
    components: { SidebarMenuItem },
    setup() {
        const store = useStore()
        const menu = store.state.menuOptions.menu

        const { toggleSidebar, sidebarWidth, collapsed, isMobileVersion } =
            useSidebar()

        return {
            menu,
            collapsed,
            sidebarWidth,
            toggleSidebar,
            isMobileVersion,
        }
    },
})
