<template>
    <li v-if="can" class="menu-item" :class="{ active: isActive }">
        <!-- Menu link -->
        <Link
            v-if="children.length === 0"
            :href="to"
            class="link"
            @click="colapsarSidebar()"
        >
            <i
                v-show="!isMobileVersion || !collapsed"
                class="icon"
                :class="icon"
            />
            <span
                class="flex-grow-1 text-start menu-item-name"
                v-show="!collapsed"
            >
                <slot />
            </span>
        </Link>

        <!-- Menu toggle -->
        <div
            v-else
            @click="toggleSubmenu"
            class="link"
            :class="{ 'cursor-pointer': !collapsed }"
        >
            <i class="icon" :class="icon" />
            <span
                class="flex-grow-1 text-start menu-item-name"
                v-show="!collapsed"
            >
                <slot />
            </span>
            <i
                v-if="showArrow"
                class="bi bi-chevron-right arrow"
                :class="{ 'rotate-arrow': openSubmenu }"
            />
        </div>

        <!-- Contenedor de Submenu-->
        <ul
            class="submenu"
            :class="{
                'show-as-floating-submenu': collapsed,
                'd-block': openSubmenu,
            }"
        >
            <!-- Muestra el titulo si el item tiene hijos o es del nivel 1 -->
            <li v-if="collapsed && (children.length > 0 || !tienePadre)">
                <span class="fw-bold"><slot /></span>
            </li>
            <!-- Submenu-->
            <sidebar-menu-item
                v-for="child of children"
                :key="child.route"
                :to="child.route"
                icon="bi bi-circle"
                :children="child.children ? child.children : []"
                class="submenu-item"
                :has-parent="true"
                >{{ child.title }}
            </sidebar-menu-item>
        </ul>
    </li>
</template>

<script src="./TheSidebarMenuItem.ts"></script>

<style lang="scss" scoped>
.cursor-pointer {
    cursor: pointer;
}

.rotate-arrow {
    transform: rotate(90deg);
}

.menu-item {
    font-size: 14px;
    white-space: nowrap;
    transition: all 1s ease;

    &.active {
        background: #7aa815;
        margin: 0 8px;
        border-radius: 8px;
        box-shadow: 0 0 10px 1px rgba(122, 168, 21, 0.5);

        .link > * {
            color: #fff !important;
            font-weight: bold;
        }
    }

    &:active {
        transform: scale(1.4);
    }

    .link {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.3s ease;
        color: rgba(0, 0, 0, 0.8);

        &:hover {
            transform: translate(4px);
        }

        .menu-item-name {
            font-size: 14px;
            transition: all 0.4s ease;
        }

        i {
            min-width: 66px;
            text-align: center;
            line-height: 48px;
            transition: all 0.3s ease;

            &:first-child {
                font-size: 20px;
            }
        }
    }

    /* Submenu */
    .submenu {
        padding-left: 0;
        display: none;
        list-style: none;

        i:first-child {
            font-size: 10px !important;
        }
    }

    &:hover .submenu {
        top: 0;
        opacity: 1;
        pointer-events: auto;
        transition: all 0.3s ease;
    }
}
</style>
