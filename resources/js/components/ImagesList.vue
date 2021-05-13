<template>
    <div>
        <h1>See images</h1>
        <image-card v-for="imageUrl in imagesUrl" :imageUrl="imageUrl">
        </image-card>
    </div>
</template>

<script>
import ImageService from "../services/ImageService";
import ImageCard from "./ImageCard";

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

