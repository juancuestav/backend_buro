<template>
    <div>
        <div class="input-group mb-2">
            <input
                ref="refFileInput"
                type="file"
                class="form-control"
                :disabled="disabled"
                accept=".jpg, .png, .gif, .jpeg"
                @change="anadirImagen"
            />
            <button
                v-if="permitirEliminarComponente"
                class="eliminar-componente"
                @click="borrarImagen()"
            >
                <i class="bi-x-lg"></i>
            </button>
        </div>

        <div v-if="archivo !== null" class="card-imagen">
            <button
                type="button"
                v-if="!disabled"
                class="btn-x"
                @click="borrarImagen()"
            >
                <i class="bi bi-x-lg" />
            </button>
            <img :img="imagenRenderizada" :src="imagen" class="imagen" />
        </div>
    </div>
</template>

<script lang="ts">
import { computed, defineComponent, ref, watch } from "@vue/runtime-core"

export default defineComponent({
    name: "SelectorImagen",
    props: {
        archivo: {
            type: String,
            default: null,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        permitirEliminarComponente: {
            type: Boolean,
            default: false,
        },
    },
    setup(props, context) {
        const refFileInput = ref()
        const file = ref()
        const imagen = ref()

        const imagenRenderizada = computed(() => {
            return props.archivo ? renderizarImagen(props.archivo) : file.value
        })

        const renderizarImagen = (archivo: any) => {
            if (typeof props.archivo !== "string" && props.archivo !== null) {
                const reader = new FileReader()
                reader.readAsDataURL(archivo)
                reader.onload = (e) => (imagen.value = e.target?.result)
                reader.onerror = () => (imagen.value = null)
            } else {
                imagen.value = archivo
            }
            return file
        }

        const anadirImagen = async (event: any) => {
            if (event.isTrusted) {
                file.value = event.target.files[0]
                event.stopPropagation()
                context.emit("change", file.value)
            }
        }

        const borrarImagen = () => {
            file.value = null
            refFileInput.value.value = ""

            context.emit("change", file.value)
        }

        // Observer to reset the input
        watch(
            computed(() => props.archivo),
            (archivo) => {
                if (!archivo) {
                    refFileInput.value.value = ""
                }
            }
        )

        return {
            refFileInput,
            file,
            imagen,
            imagenRenderizada,
            anadirImagen,
            borrarImagen,
        }
    },
})
</script>

<style scoped>
.card-imagen {
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 5px;
}

.imagen {
    max-height: 180px;
    border-radius: 5px;
    width: 100%;
    object-fit: cover;
}

.btn-x {
    position: absolute;
    top: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    color: #fff;
    padding: 1px 5px;
    margin: 4px;
    border: none;
    border-radius: 50%;
    transition: all 0.15s ease;
}

.card-imagen:hover .btn-x {
    transform: scale(1.2) translate3d(30%, -30%, 0);
    background-color: #fff;
    color: #979797;
    box-shadow: 1px 1px 4px rgba(44, 54, 92, 0.6);
}

.eliminar-componente {
    border-radius: 50px;
    border: 1px solid #ddd;
    padding: 0 8px;
}
</style>
