import { computed, defineComponent, ref } from "vue"
import { useStore } from "vuex"
import { Link } from "@inertiajs/inertia-vue3"
import { MenuItem } from "./domain/MenuItem"
import useSidebar from "../composables/useSidebar"

export default defineComponent({
    name: "SidebarMenuItem",
    props: {
        to: { type: String, required: true },
        icon: { type: String, required: true },
        children: { type: Array as () => MenuItem[], required: true },
        hasParent: { type: Boolean, required: true },
        can: { type: Boolean, default: true },
    },
    components: { Link },
    setup(props) {
        const store = useStore()

        const collapsed = computed(() => store.state.sidebar.collapsed)
        const isActive = computed(() => window.location.href === props.to)
        const showArrow = computed(
            () => props.children.length > 0 && !collapsed.value
        )

        const openSubmenu = ref(false)

        const toggleSubmenu = () => {
            openSubmenu.value = !openSubmenu.value
        }

        const { isMobileVersion } = useSidebar()

        function colapsarSidebar() {
            if (isMobileVersion.value) {
                store.dispatch("sidebar/toggleSidebar")
            }
        }

        return {
            // ref
            collapsed,
            openSubmenu,
            // computed properties
            isMobileVersion,
            isActive,
            showArrow,
            tienePadre: computed(() => props.hasParent),
            // functions
            toggleSubmenu,
            colapsarSidebar,
        }
    },
})
