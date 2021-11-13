<template>
    <div class="row d-flex justify-content-start m-2">
        <input
            class="form-control"
            type="text"
            placeholder="Search"
            v-bind:value="searchInput"
            @change="updateSearchTerm($event.target.value)"

        />
    </div>
</template>

<script>
export default {
    name: "Searchbar",
    props: ['searchInput'],
    methods: {
        updateSearchTerm(searchInput) {
            this.$emit('updateInput', searchInput);
        }
    }
}
</script>

<style scoped>

</style>
