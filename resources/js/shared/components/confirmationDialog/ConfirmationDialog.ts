type ParamsModal = {
    mensaje: string
    btnConfirmText?: string
    btnCancelText?: string
    enableInput?: boolean
    placeholder?: string
    confirmFunction: (inputValue?: string) => Promise<void>
}

export default class ConfirmationDialog {
    private static modalContainer = document.createElement("div")
    private static customModal = document.createElement("div")
    private static section = document.createElement("section")
    private static p = document.createElement("p")
    private static span = document.createElement("span")
    private static input = document.createElement("input")
    private static footer = document.createElement("footer")
    private static btnConfirm = document.createElement("button")
    private static btnCancel = document.createElement("button")
    private static cbConfirmar: (inputValue?: string) => Promise<void>
    private static enableInput = false

    static mostrar(params: ParamsModal) {
        this.enableInput = params.enableInput ?? false
        if (!this.enableInput) {
            this.input.remove()
        } else {
            this.input.value = ""
        }

        const fragment = new DocumentFragment()

        this.cbConfirmar = params.confirmFunction

        this.modalContainer.classList.add("modal-container", "modal-open")
        this.customModal.classList.add("row", "bg-white", "py-4", "px-2", "rounded-3")
        this.section.classList.add("text-center", "col-12")
        this.span.innerText = params.mensaje
        this.footer.classList.add(
            "col",
            "d-grid",
            "gap-2",
            "d-md-flex",
            `justify-content-md-center`
        )

        this.btnConfirm.classList.add("btn", "btn-primary")
        this.btnConfirm.innerText = params.btnConfirmText ?? "Confirmar"

        this.btnCancel.classList.add("btn", "btn-danger", "text-white")
        this.btnCancel.innerText = params.btnCancelText ?? "Cancelar"

        // Append child
        this.modalContainer.appendChild(this.customModal)

        this.customModal.appendChild(this.section)
        this.customModal.appendChild(this.footer)

        this.section.appendChild(this.p)
        this.p.appendChild(this.span)

        if (this.enableInput) {
            this.input.classList.add("form-control", "mb-4")
            this.input.setAttribute("Placeholder", params.placeholder ?? "")
            this.input.setAttribute("id", "inputId")
            this.input.setAttribute("autofocus", "")
            this.section.appendChild(this.input)
        }

        this.footer.appendChild(this.btnConfirm)
        this.footer.appendChild(this.btnCancel)

        fragment.appendChild(this.modalContainer)

        this.modalContainer.setAttribute("id", "modalContainer")

        document.body.appendChild(fragment)

        const confirmar = (event) => {
            if (this.enableInput) {
                const inputValue: any = document.getElementById("inputId")
                this.cbConfirmar(inputValue.value)
            } else {
                this.cbConfirmar()
            }
            cerrarModal()
        }

        const cerrarModal = () => {
            this.modalContainer.classList.remove("modal-open")
            this.btnConfirm.removeEventListener("click", confirmar)
        }

        // Eventos
        this.btnConfirm.addEventListener("click", confirmar)
        this.btnCancel.addEventListener("click", () => cerrarModal())
    }
}
