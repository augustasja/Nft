<template>
    <div class="col">
        <Searchbar @updateInput="updateSearchValue"/>
        <div class="row">
            <div class="col-md-3 my-2 p-1" v-for="asset in assets.data" :key="asset.id">
                <Asset :asset="asset"/>
            </div>
        </div>
        <pagination :data="assets" :limit="5" @pagination-change-page="loadData"></pagination>
    </div>
</template>

<script>
import Searchbar from "./Searchbar";
import Asset from "../Asset";
import axios from "axios";

export default {
    data() {
        return {
            searchValue: '',
            isLoading: true,
            assets: {},
        }
    },
    components: {
        Searchbar,
        Asset
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData(page = 1) {
            return axios.get(`api/get-all?page=${page}&search=${this.searchValue}`)
                .then(response => {
                    this.assets = response.data;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        updateSearchValue(params) {
            this.searchValue = params;
            let re = /[^a-zA-Z0-9 ]/;
            if(re.test(this.searchValue)){
                alert("Special characters not allowed");
            } else {
                this.loadData();
            }
        }
    },
    name: "Body"
}
</script>
