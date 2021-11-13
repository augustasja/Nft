<template>
    <div class="card w-auto">
        <img v-bind:src="asset.image.asset_image" class="card-img-top" alt="">
        <div class="card-body">
            <h5 class="card-title">{{ asset.name }}</h5>
            <p class="card-text">description</p>
        </div>
        <div class="card-body">
            <a href="#" class="card-link"></a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "Asset",
    props: {
        asset: Object
    }
}
</script>
