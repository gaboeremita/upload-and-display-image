<template>
    <div>
        <h1 class="h1 mb-2">See images</h1>
        <div class="container">
            <div class="row">
                <image-card class="col-4 py-2 px-1" v-for="(imageUrl, index) in imagesUrl" :key="index" :imageUrl="imageUrl">
                </image-card>
            </div>
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
            imagesUrl: []
        };
    },
    created() {
        this.imagesUrl = ImageService.getImagesUrl();
    }
}
</script>

