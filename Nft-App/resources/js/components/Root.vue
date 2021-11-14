<template>
    <div class="container">
        <Body/>
    </div>
</template>

<script>
import Body from "./layout/Body";

export default {
    components: {
        Body
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
