<template>
    <sidebar-layout>
        <DropZone
            class="drop-area"
            @files-dropped="addFiles"
            #default="{ dropZoneActive }"
        >
            <label for="file-input">
                <span v-if="dropZoneActive">
                    <span>Soltar aquí</span>
                    <span class="smaller">para agregarlo</span>
                </span>
                <span v-else>
                    <span>Arrastra tus archivos aquí</span>
                    <span class="smaller">
                        o <strong><em>haz click aquí</em></strong> para
                        seleccionar archivos
                    </span>
                </span>

                <input
                    type="file"
                    id="file-input"
                    multiple
                    @change="onInputChange"
                />
            </label>
            <ul class="image-list" v-show="files.length">
                <FilePreview
                    v-for="file of files"
                    :key="file.id"
                    :file="file"
                    tag="li"
                    @remove="removeFile"
                />
            </ul>
        </DropZone>

        <div class="row mt-4">
            <div class="col d-grid gap-2 d-md-flex justify-content-md-center">
                <button
                    @click.prevent="uploadFiles(files, carpetaActual)"
                    class="btn btn-primary"
                >
                    Subir
                </button>
                <button class="btn btn-light" @click="volver()">Volver</button>
            </div>
        </div>
    </sidebar-layout>
</template>

<script lang="ts" src="./SubirArchivosPage.ts"></script>

<style lang="scss" scoped>
.drop-area {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    padding: 50px;
    border: 2px dashed #ccc;
    transition: 0.2s ease;
    border-radius: 8px;
    &[data-active="true"] {
        background: #eee;
    }
}

label {
    font-size: 36px;
    cursor: pointer;
    display: block;
    text-align: center;
    span {
        display: block;
    }
    input[type="file"]:not(:focus-visible) {
        // Visually Hidden Styles taken from Bootstrap 5
        position: absolute !important;
        width: 1px !important;
        height: 1px !important;
        padding: 0 !important;
        margin: -1px !important;
        overflow: hidden !important;
        clip: rect(0, 0, 0, 0) !important;
        white-space: nowrap !important;
        border: 0 !important;
    }
    .smaller {
        font-size: 16px;
    }
}

.image-list {
    display: flex;
    list-style: none;
    flex-wrap: wrap;
    padding: 0;
}
/* .upload-button {
    display: block;
    appearance: none;
    border: 0;
    border-radius: 50px;
    padding: 0.75rem 3rem;
    margin: 1rem auto;
    font-size: 1.25rem;
    font-weight: bold;
    background: #369;
    color: #fff;
    text-transform: uppercase;
} */
button {
    cursor: pointer;
}
</style>
