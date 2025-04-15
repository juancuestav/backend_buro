import { useStore } from "vuex"
import { computed } from "vue"

const useSidebar = () => {
    const store = useStore()
    const isMobileVersion = computed(() => store.state.sidebar.isMobileVersion)
    const sidebarWidth = computed(() => store.getters[`sidebar/sidebarWidth`])

    return {
        isMobileVersion,
        sidebarWidth,
        toggleSidebar: () => store.dispatch("sidebar/toggleSidebar"),
        collapsed: computed(() => store.state.sidebar.collapsed),
        marginLeftPage: computed(() =>
            isMobileVersion.value ? 0 : sidebarWidth.value
        ),
    }
}

export default useSidebar
