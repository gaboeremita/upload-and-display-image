<template>
    <div class="col-6 col-lg-4 d-flex" >
        <div class="card flex-fill">
            <img class="card-img-top" :src="image.url" alt="Image">
            <div class="card-body">
                <p class="card-text">{{ image.name }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['image']
}
</script>
