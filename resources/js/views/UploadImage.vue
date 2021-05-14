<template>
    <div class="d-flex justify-content-center upload-image-section">
        <form enctype="multipart/form-data" novalidate>
            <h1 class="h1">Upload images</h1>
            <div class="dropbox p-4">
                <input type="file" :name="uploadFieldName" :disabled="isSaving"
                       @change="uploadImages($event)"
                       accept="image/png">
                <p class="paragraph" v-if="isInitial">
                    Drag your file(s) here to begin<br> or click the button to browse
                </p>
                <p class="paragraph" v-if="isSaving">
                    Uploading files...
                </p>
                <p class="paragraph" v-if="isSuccess">
                    Image uploaded successfully. Upload another one?
                </p>
                <p class="paragraph text-danger" v-if="isFailed">
                    An error occurred. Please try again.
                    <br>
                    Error: {{ uploadError }}
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
            uploadError: null,
            currentStatus: null,
            uploadFieldName: 'image'
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
            this.currentStatus = STATUS_INITIAL;
            this.uploadedFiles = [];
            this.uploadError = null;
        },
        uploadImages(event) {
            this.reset();
            let formData = new FormData();

            formData.append(this.uploadFieldName, event.target.files[0]);

            if (!event.target.files.length) return;

            this.currentStatus = STATUS_SAVING;

            ImageService
                .postImage(formData)
                .then(response => {
                    ImageService.pushImageToSession(response.data.imageUrl)
                    this.currentStatus = STATUS_SUCCESS;
                })
                .catch(err => {
                    this.uploadError = err.response.data.message;
                    this.currentStatus = STATUS_FAILED;
                });
        }
    },
    mounted() {
        this.reset();
    },
}
</script>
