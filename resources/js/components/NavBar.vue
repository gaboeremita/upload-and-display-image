<template>
    <div>
        <nav>
            <router-link :to="{ name: 'upload-image' }">Upload Image</router-link> |
            <router-link :to="{ name: 'images-list' }">See Images</router-link>
        </nav>
    </div>
</template>
<script>
export default {}
</script>
