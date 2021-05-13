<template>
    <div>
        <img :src="imageUrl" alt="Image">
    </div>
</template>

<script>
export default {
    props: ['imageUrl']
}
</script>
