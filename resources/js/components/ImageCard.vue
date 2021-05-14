<template>
    <div class="col-6 col-lg-4 d-flex" >
        <div class="card flex-fill">
            <img class="card-img-top" :src="imageUrl" alt="Image">
            <div class="card-body">
                <p class="card-text">Image name</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['imageUrl']
}
</script>
