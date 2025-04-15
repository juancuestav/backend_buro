// Dependencias
import { getEndpoint } from "@shared/http/utils"
import { defineComponent, computed } from "vue"
import { endpoints } from "@config/api.config"
import { useStore } from "vuex"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import CustomDropdown from "@components/customDropdown/view/CustomDropdown.vue"
import FloatingButton from "@components/floatingButton/view/FloatingButton.vue"
import useFileList from "@components/dropzone/application/fileList"
import DropZone from "@components/dropzone/view/Dropzone.vue"
import FilePreview from "@components/dropzone/view/FilePreview.vue"

// Logica y controladores
import createUploader from "@components/dropzone/application/uploadFiles"
import { GestionarNiveles } from "../../gestor/application/GestionarNiveles"

export default defineComponent({
    components: {
        SidebarLayout,
        CustomDropdown,
        FloatingButton,
        DropZone,
        FilePreview,
    },
    setup() {
        const { files, addFiles, removeFile } = useFileList()

        function onInputChange(e) {
            addFiles(e.target.files)
            e.target.value = null
        }

        const { uploadFiles } = createUploader(getEndpoint(endpoints.archivos))

        const store = useStore()
        const carpetaActual = computed(
            () => store.state.gestorArchivos.carpetaActual
        )

        const gestionarNiveles = new GestionarNiveles()
        async function cargarSubnivel(idCarpeta: number) {
            try {
                const { subarchivos, subcarpetas, idCarpetaPadre } =
                    await gestionarNiveles.consultarSubnivel(idCarpeta)

                store.commit("gestorArchivos/SET_ARCHIVOS", subarchivos)
                store.commit("gestorArchivos/SET_CARPETAS", subcarpetas)
                store.commit("gestorArchivos/SET_CARPETA_PADRE", idCarpetaPadre)
            } catch (error) {
                console.log("Error al obtener el recurso.")
            }
        }

        function volver() {
            store.commit("gestorArchivos/SET_SUBIR_ARCHIVOS", false)
            cargarSubnivel(store.state.gestorArchivos.carpetaActual)
        }

        return {
            files,
            addFiles,
            removeFile,
            onInputChange,
            uploadFiles,
            volver,
            carpetaActual,
        }
    },
})
