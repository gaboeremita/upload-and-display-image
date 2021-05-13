<template>
    <div class="container">
        <form enctype="multipart/form-data" novalidate v-if="isInitial || isSaving">
            <h1>Upload images</h1>
            <div class="dropbox">
                <input type="file" :name="uploadFieldName" :disabled="isSaving"
                       @change="uploadImages($event)"
                       accept="image/*">
                <p v-if="isInitial">
                    Drag your file(s) here to begin<br> or click to browse
                </p>
                <p v-if="isSaving">
                    Uploading files...
                </p>
            </div>
        </form>
    </div>
</template>

<script>
import ImageService from "../services/ImageService";

const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;

export default {
    components: {
        ImageService
    },
    data() {
        return {
            uploadedFiles: [],
            uploadError: null,
            currentStatus: null,
            uploadFieldName: 'photos'
        }
    },
    computed: {
        isInitial() {
            return this.currentStatus === STATUS_INITIAL;
        },
        isSaving() {
            return this.currentStatus === STATUS_SAVING;
        },
        isSuccess() {
            return this.currentStatus === STATUS_SUCCESS;
        },
        isFailed() {
            return this.currentStatus === STATUS_FAILED;
        }
    },
    methods: {
        reset() {
            // reset form to initial state
            this.currentStatus = STATUS_INITIAL;
            this.uploadedFiles = [];
            this.uploadError = null;
        },
        uploadImages(event) {
            // handle file changes
            let formData = new FormData();

            formData.append('image', event.target.files[0]);

            if (!event.target.files.length) return;

            this.currentStatus = STATUS_SAVING;

            ImageService
                .postImage(formData)
                .then(response => {

                    ImageService.pushImageToSession(response.data.imageUrl)

                    this.currentStatus = STATUS_SUCCESS;
                })
                .catch(err => {
                    this.uploadError = err.response;
                    this.currentStatus = STATUS_FAILED;
                });
        }
    },
    mounted() {
        this.reset();
    },

}
</script>
