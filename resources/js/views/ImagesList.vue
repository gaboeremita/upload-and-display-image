<template>
    <div>
        <h4 class="h4 mx-3 mb-2">See images</h4>
        <div v-if="imagesUrl !== null" class="container">
            <div class="row">
                <image-card v-for="(imageUrl, index) in imagesUrl" :key="index" :imageUrl="imageUrl">
                </image-card>
            </div>
        </div>
        <div v-else>
            <h3>
                <small class="text-muted">
                    There are no images to see yet.
                </small>
            </h3>
            <h4 class="h4">
            </h4>
        </div>
    </div>
</template>

<script>
import ImageService from "../services/ImageService";
import ImageCard from "../components/ImageCard";

export default {
    components: {
        ImageCard
    },
    data() {
        return {
            imagesUrl: null
        };
    },
    created() {
        this.imagesUrl = ImageService.getImagesUrl();
    }
}
</script>

