<template>
    <div class="container">
        <div class="row vh-100">
            <Sidebar/>
            <Body/>
        </div>
        <div class="content"></div>
    </div>
</template>

<script>
import Sidebar from "./layout/Sidebar";
import Body from "./layout/Body";

export default {
    components: {
        Sidebar,
        Body
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
