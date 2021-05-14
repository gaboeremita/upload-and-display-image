<template>
    <div class="card text-center">
        <div class="card-header mt-2">
            <h4 class="card-title">
                Upload images
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
                        Drag your images(s) here to begin<br> or click the button to browse
                    </p>
                    <div v-else-if="isSaving" class="progress-container progress-primary">
                            <span class="progress-badge">
                                Uploading {{ fileCount }} images...
                            </span>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                 :aria-valuenow="percentage" aria-valuemin="0" aria-valuemax="100"
                                 :style="{ width: percentage + '%' }"
                            >
                                <span class="progress-value">{{ percentage }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer mb-2 d-flex justify-content-center">
            <div v-if="isFailed" class="alert alert-danger" role="alert">
                <strong>An error occurred. Please try again.</strong>
                <br>
                Error: {{ uploadError }}
            </div>
            <div v-else-if="isSuccess" class="alert alert-success" role="alert">
                <div class="container">
                    <div class="alert-icon">
                        <i class="now-ui-icons ui-2_like"></i>
                    </div>
                    <strong>Images uploaded successfully!</strong> Upload another one?
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ImageService from "../services/ImageService";

const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;

export default {
    data() {
        return {
            percentage: 0,
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
            this.percentage = 0;
            this.currentStatus = STATUS_INITIAL;
            this.uploadedFiles = [];
            this.uploadError = null;
        },
        save(formData) {
            this.currentStatus = STATUS_SAVING;

            ImageService
                .postImage(formData)
                .then(response => {
                    this.increaseProgressPercentage(25);

                    ImageService.pushImagesToSession(response.data.imagesArray)
                    this.increaseProgressPercentage(24);

                    this.currentStatus = STATUS_SUCCESS;
                    this.percentage = 0;
                })
                .catch(err => {
                    this.uploadError = err.response.data.message;
                    this.percentage = 0;
                    this.currentStatus = STATUS_FAILED;
                });

        },
        uploadImages(fileList) {
            this.reset();

            this.currentStatus = STATUS_SAVING;

            let formData = new FormData();

            if (!fileList.length) return;

            this.increaseProgressPercentage(25);

            Array
                .from(Array(fileList.length).keys())
                .map(x => {
                    formData.append(this.uploadFieldName, fileList[x], fileList[x].name);
                });

            this.increaseProgressPercentage(25);

            this.save(formData);
        },
        increaseProgressPercentage(quantity) {
            this.percentage += quantity;
        }
    },
    mounted() {
        this.reset();
    },
}
</script>
