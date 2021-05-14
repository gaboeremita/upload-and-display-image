<template>
    <div class="card text-center">
        <div class="card-header mt-2">
            <h4 class="card-title">
                Upload image
            </h4>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" novalidate>
                <div>
                    <input type="file" multiple :name="uploadFieldName" :disabled="isSaving"
                           @change="uploadImages($event.target.files); fileCount = $event.target.files.length"
                           accept="image/png"
                           class="btn btn-primary"
                    >
                    <p class="card-text" v-if="isInitial">
                        Drag your file(s) here to begin<br> or click the button to browse
                    </p>
                    <p class="card-text" v-if="isSaving">
                        Uploading {{ fileCount }} files...
                    </p>
                    <p class="card-text" v-if="isSuccess">
                        Image uploaded successfully. Upload another one?
                    </p>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted text-danger mb-2">
            <p v-if="isFailed">
                An error occurred. Please try again.
                <br>
                Error: {{ uploadError }}
            </p>
        </div>
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
            uploadFieldName: 'images[]'
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
        save(formData) {
            this.currentStatus = STATUS_SAVING;

            ImageService
                .postImage(formData)
                .then(response => {
                    ImageService.pushImagesToSession(response.data.imagesArray)
                    this.currentStatus = STATUS_SUCCESS;
                })
                .catch(err => {
                    this.uploadError = err.response.data.message;
                    this.currentStatus = STATUS_FAILED;
                });

        },
        uploadImages(fileList) {
            this.reset();

            let formData = new FormData();

            if (!fileList.length) return;

            Array
                .from(Array(fileList.length).keys())
                .map(x => {
                    formData.append(this.uploadFieldName, fileList[x], fileList[x].name);
                });

            this.currentStatus = STATUS_SAVING;

            this.save(formData);
        }
    },
    mounted() {
        this.reset();
    },
}
</script>
