/* eslint-disable @typescript-eslint/explicit-module-boundary-types */
export default {
    namespaced: true,
    state: () => ({
        collapsed: false,
        SIDEBAR_WIDTH: 260,
        SIDEBAR_WIDTH_COLLAPSED: 72,

        SIDEBAR_MOBILE_WIDTH: 260,
        SIDEBAR_MOBILE_WIDTH_COLLAPSED: 0,

        isMobileVersion: window.innerWidth < 768,
    }),
    mutations: {
        TOGGLE_SIDEBAR(state: { collapsed: boolean }, value: boolean) {
            state.collapsed = value
        },
    },
    actions: {
        toggleSidebar({ state, commit }: any) {
            commit("TOGGLE_SIDEBAR", !state.collapsed)
        },
    },
    getters: {
        sidebarWidth(state: any) {
            if (state.isMobileVersion) {
                return `${
                    state.collapsed
                        ? state.SIDEBAR_MOBILE_WIDTH_COLLAPSED
                        : state.SIDEBAR_MOBILE_WIDTH
                }px`
            }
            return `${
                state.collapsed
                    ? state.SIDEBAR_WIDTH_COLLAPSED
                    : state.SIDEBAR_WIDTH
            }px`
        },
    },
}
