<template>
    <div class="card" @click="clickEvent">
        <div
            class="card-custom-header"
            :style="{
                backgroundImage:
                    'linear-gradient(to bottom, rgba(255, 255, 255, 0) 4%, rgba(0, 0, 0, 0.15) 300%), url(' +
                    card_image_url +
                    ')',
            }"
        >
            <div class="wrapper-buttons-card">
                <div
                    v-if="permitirCustomAction"
                    v-tooltip:top="'Galeria'"
                    class="custom-action me-1 text-primary"
                    @click.stop="$emit('customAction')"
                >
                    <i class="bi-images"></i>
                </div>
                <div
                    v-if="permitirCustomAction2"
                    v-tooltip:top="'Videos'"
                    class="custom-action me-1 text-primary"
                    @click.stop="$emit('customAction2')"
                >
                    <i class="bi-play-btn"></i>
                </div>
                <div
                    class="delete-card text-primary"
                    v-tooltip:top="'Eliminar'"
                    @click.stop="$emit('eliminar')"
                >
                    <i class="bi-x-lg"></i>
                </div>
            </div>
            <span class="nombre-empresa">
                {{ card_subtitle }}
            </span>
        </div>
    </div>
</template>

<script lang="ts">
import { computed, defineComponent } from "vue"

export default defineComponent({
    name: "CardImage",
    props: {
        imageUrl: { type: String, required: true },
        title: { type: String, required: true },
        subtitle: { type: String, required: true },
        permitirCustomAction: {
            type: Boolean,
            default: false,
        },
        permitirCustomAction2: {
            type: Boolean,
            default: false,
        },
        customAction: {
            type: Function,
            required: false,
        },
        customAction2: {
            type: Function,
            required: false,
        },
    },
    emits: ["clickEvent", "eliminar", "customAction", "customAction2"],
    setup(props, { emit }) {
        const clickEvent = () => {
            emit("clickEvent")
        }

        return {
            card_image_url: computed(() => props.imageUrl),
            card_title: computed(() => props.title),
            card_subtitle: computed(() => props.subtitle),
            clickEvent,
        }
    },
})
</script>

<style lang="scss" scoped>
.card-custom-header {
    height: 215px;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    background-position: center;

    .nombre-empresa {
        color: #001932;
        align-self: center;
        width: 100%;
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.7);
        text-align: center;
        padding: 8px;
        font-weight: bold;
        border-top: 1px solid #c29868;
        border-bottom: 1px solid #c29868;
    }
}

.wrapper-buttons-card {
    position: absolute;
    top: 0;
    right: 0;
    margin: 4px;
    display: flex;

    .delete-card {
        padding: 4px 8px;
        border-radius: 6px;
        background-color: #fff;
        box-shadow: 1px 1px 4px rgba(44, 54, 92, 0.6);
        transition: all 0.15s ease;

        &:hover {
            transform: rotate(90deg);
        }
    }

    .custom-action {
        padding: 4px 8px;
        border-radius: 6px;
        background-color: #fff;
        box-shadow: 1px 1px 4px rgba(44, 54, 92, 0.6);
        transition: all 0.15s ease;

        &:hover {
            transform: scale(1.1);
        }
    }
}
</style>
