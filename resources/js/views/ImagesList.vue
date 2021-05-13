<template>
    <div>
        <h1>See images</h1>
        <image-card v-for="(imageUrl, index) in imagesUrl" :key="index" :imageUrl="imageUrl">
        </image-card>
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

