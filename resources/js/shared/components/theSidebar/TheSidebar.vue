<template>
    <!-- Backdrop -->
    <div
        v-show="!collapsed && isMobileVersion"
        class="backdrop-sidebar"
        @click="toggleSidebar()"
    ></div>

    <!-- Sidebar -->
    <div
        class="sidebar"
        :style="{ width: sidebarWidth }"
        :class="{ collapsed: collapsed }"
    >
        <!-- Header -->
        <a
            v-show="!isMobileVersion || (isMobileVersion && !collapsed)"
            href="/"
            class="sidebar-header"
        >
            <img src="/img/logo.webp" class="mx-3 logo" />
            <span class="text-primary logo-name">BRC APP</span>
        </a>

        <!-- Body -->
        <ul class="content-links">
            <sidebar-menu-item
                @click="toggleSidebar()"
                to="#"
                icon="bi-arrow-bar-left"
                :children="[]"
                :has-parent="false"
                >{{ 'Ocultar panel' }}</sidebar-menu-item
            >
            <sidebar-menu-item
                v-for="menuItem in menu"
                :key="menuItem.route"
                :to="menuItem.route"
                :icon="menuItem.icon"
                :children="menuItem.children ? menuItem.children : []"
                :has-parent="false"
                :can="menuItem.can"
                >{{ menuItem.title }}</sidebar-menu-item
            >
        </ul>
    </div>
</template>

<script src="./TheSidebar.ts"></script>

<style lang="scss" scoped>
.backdrop-sidebar {
    background-color: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100vh;
    z-index: 100;
    position: absolute;
    top: 0;
    left: 0;
}
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    transition: 0.1s ease-out;
    z-index: 200;
    display: flex;
    flex-direction: column;
    // border-radius: 0 16px 16px 0;
    background: #fff;
    box-shadow: rgba(44, 54, 92, 0.2) 0px 5px 15px;

    // Header
    .sidebar-header {
        height: 60px;
        padding-top: 8px;
        width: 100%;
        display: flex;
        align-items: center;
        text-decoration: none;
        cursor: pointer;

        .logo-name {
            font-size: 22px;
            font-weight: 400;
        }

        .logo {
            width: 40px;
        }
    }

    &.collapsed .logo-name {
        opacity: 0;
        pointer-events: none;
    }

    // Body
    .content-links {
        height: 100%;
        padding: 30px 0 30px 0;
        overflow-y: auto;
        overflow-x: hidden;

        &::-webkit-scrollbar {
            width: 2px;
            background-color: #fff;
        }

        &::-webkit-scrollbar-thumb {
            background: #7aa815;
            border-radius: 50px;
        }
    }

    // Footer
    .footer-sidebar {
        text-align: center;
        margin: 6px 0;
        border-radius: 6px 6px 20px 6px;
        font-weight: bold;
        background-color: #ddd;
        transition: transform 0.3s ease;

        &:hover {
            transform: scale(0.98);
        }
        &:active {
            transform: scale(1.04);
        }
    }
}
</style>
