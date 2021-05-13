<template>
    <div>
        <h1>See images</h1>
        <div v-for="image in images">
            image
        </div>
    </div>
</template>

<script>
import ImageService from "../services/ImageService";

export default {
    data() {
        return {
            images: []
        };
    },
    created() {
        this.images = ImageService.getImages();
    }
}
</script>

