<template>
    <div>
        <nav class="navbar sticky-top navbar-expand-lg bg-primary">
            <div class="container justify-content-center">
                <router-link :to="{ name: 'upload-image' }" class="nav-link">Upload Image</router-link>
                <router-link :to="{ name: 'images-list' }" class="nav-link">See Images</router-link>
            </div>
        </nav>
    </div>
</template>
<script>
export default {}
</script>
