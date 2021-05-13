<template>
    <div>
        <nav class="navbar navbar-dark bg-dark justify-content-center">
            <router-link :to="{ name: 'upload-image' }" class="nav-link text-light">Upload Image</router-link>
            <router-link :to="{ name: 'images-list' }" class="nav-link text-light">See Images</router-link>
        </nav>
    </div>
</template>
<script>
export default {}
</script>
