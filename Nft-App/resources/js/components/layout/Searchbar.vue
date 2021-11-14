<template>
    <div class="row m-0 my-2">
        <input
            class="form-control search shadow-none"
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
