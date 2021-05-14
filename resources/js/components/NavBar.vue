<template>
    <div>
        <nav class="navbar sticky-top navbar-expand-lg bg-primary">
            <div class="container justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link :to="{ name: 'upload-image' }" class="nav-link" exact>Upload Image</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'images-list' }" class="nav-link">See Images</router-link>
                    </li>
                </ul>


            </div>
        </nav>
    </div>
</template>
<script>
export default {}
</script>
