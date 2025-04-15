<template>
    <div v-if="mostrarChat" class="chat">
        <div class="header-chat">
            <span>{{
                `${notificacion.data.nombre} ${notificacion.data.apellidos}`
            }}</span>
            <i @click="ocultarChat()" class="bi-x-lg cursor-pointer"></i>
        </div>
        <div class="body-chat">
            <small class="text-secondary d-block py-2"
                >Seleccione el medio de envío del mensaje</small
            >
            <!-- Gmail -->
            <div class="form-check form-switch">
                <input
                    v-model="chat.es_correo"
                    class="form-check-input"
                    type="checkbox"
                    role="switch"
                    id="check-email"
                />
                <label class="form-check-label" for="check-email"
                    ><i class="bi-envelope me-2"></i>Correo</label
                >
            </div>

            <!-- Whatsapp -->
            <div class="form-check form-switch mb-4">
                <input
                    v-model="chat.es_whatsapp"
                    class="form-check-input"
                    type="checkbox"
                    role="switch"
                    id="check-whatsapp"
                />
                <label class="form-check-label" for="check-whatsapp"
                    ><i class="bi-whatsapp me-2"></i>Whatsapp</label
                >
            </div>

            <!-- Informacion de correo destino -->
            <div v-if="chat.es_correo" class="mb-4">
                <label class="form-label"
                    ><i class="bi-envelope text-danger me-2"></i>Correo de
                    destino</label
                >
                <input
                    type="text"
                    class="form-control"
                    :placeholder="notificacion.data.correo"
                    disabled
                />
            </div>

            <!-- Informacion de telefono destino -->
            <div v-if="chat.es_whatsapp" class="mb-4">
                <label class="form-label"
                    ><i class="bi-whatsapp text-success me-2"></i>Teléfono de
                    destino</label
                >
                <input
                    type="text"
                    class="form-control"
                    :placeholder="notificacion.data.celular"
                    disabled
                />
            </div>

            <div>
                {{ notificacion.data.mensaje }}
            </div>
        </div>

        <div class="input-chat">
            <textarea
                v-model="chat.mensaje"
                @keyup="gestionarLineas"
                class="input-message"
                placeholder="Aa"
            ></textarea>
            <button class="boton-enviar" @click="enviarMensaje()">
                <i class="bi-send"></i>
            </button>
        </div>
    </div>
</template>

<script lang="ts">
import { useNotificaciones } from "../../toastification/application/notificaciones"
import { defineComponent, computed } from "vue"
import { Chat } from "../domain/Chat"
import { useStore } from "vuex"
import { sleep } from "@/shared/utils"

export default defineComponent({
    setup() {
        const store = useStore()

        const mostrarChat = computed(() => store.state.chat.mostrar)
        const notificacion = computed(() => store.state.chat.notificacion)

        const chat = computed({
            get: () => store.state.chat.chat,
            set: (value: Chat) => store.commit("chat/SET_CHAT", value),
        })

        function gestionarLineas(e: any) {
            const textarea = document.querySelector("textarea")
            if (textarea) {
                textarea.style.height = "40px"
                let scHeight = (e.target as any)?.scrollHeight
                textarea.style.height = `${scHeight}px`
            }
        }

        function ocultarChat() {
            store.dispatch("chat/ocultarChat")
            store.dispatch("chat/resetChat")
        }

        async function enviarMensaje() {
            const { notificarAdvertencia, notificarCorrecto } =
                useNotificaciones()

            // Seleccion medio envio
            if (!chat.value.es_correo && !chat.value.es_whatsapp) {
                await sleep(0)
                return notificarAdvertencia(
                    "Debe seleccionar un medio de envio"
                )
            }

            // Mensaje vacio
            if (!chat.value.mensaje) {
                await sleep(0)
                return notificarAdvertencia("No puede enviar un mensaje vacio.")
            }

            if (chat.value.es_whatsapp) {
                const link = document.createElement("a")
                const celular = notificacion.value.data.celular
                const phone = "593" + celular.substring(1, celular.length)
                link.href = `https://web.whatsapp.com/send?text=${chat.value.mensaje}&phone=${phone}`
                link.target = "_blank"
                link.click()
            }

            ocultarChat()
            await sleep(0)
            notificarCorrecto("Mensaje enviado exitosamente!")
        }

        return {
            chat,
            mostrarChat,
            ocultarChat,
            gestionarLineas,
            notificacion,
            enviarMensaje,
        }
    },
})
</script>

<style lang="scss" scoped>
.chat {
    position: fixed;
    bottom: 0;
    right: 0;
    margin: 24px;
    border: none;
    border-radius: 24px;
    width: 350px;
    overflow: hidden;
    background-color: #fff;
    z-index: 50;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
    .header-chat {
        background-color: #7aa815;
        padding: 12px 16px;
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 1px,
            rgba(0, 0, 0, 0.02) 0px 2px 2px, rgba(0, 0, 0, 0.02) 0px 4px 4px,
            rgba(0, 0, 0, 0.02) 0px 8px 8px, rgba(0, 0, 0, 0.02) 0px 16px 16px;
        color: #fff;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
    }

    .body-chat {
        height: 300px;
        padding: 8px;
        overflow: auto;
    }

    .input-chat {
        padding: 8px;
        display: flex;
        align-items: flex-end;
        gap: 4px;
        .input-message {
            padding: 8px 16px;
            background-color: #f7f7f7;
            border-radius: 16px;
            display: block;
            border: none;
            width: 100%;
            outline: none;
            resize: none;
            max-height: 140px;
            height: 40px;

            &::-webkit-scrollbar {
                width: 0;
            }
        }

        .boton-enviar {
            background-color: #7aa815;
            color: #fff;
            border-radius: 50%;
            border: none;
            outline: none;
            padding: 8px 12px;
        }
    }
}
</style>
