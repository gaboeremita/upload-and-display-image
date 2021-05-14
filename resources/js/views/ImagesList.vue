<template>
    <div>
        <h4 class="h4 mx-3 mb-2">See images</h4>
        <div v-if="images !== null" class="container">
            <div class="row">
                <image-card v-for="(image, index) in images" :key="index" :image="image">
                </image-card>
            </div>
        </div>
        <div v-else>
            <h3>
                <small class="text-muted">
                    There are no images to see yet.
                </small>
            </h3>
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
            images: null
        };
    },
    created() {
        this.images = ImageService.getImages();
    }
}
</script>

