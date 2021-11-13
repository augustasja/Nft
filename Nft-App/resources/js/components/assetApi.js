import axios from "axios";

export default {
    // getAssets() {
    //     return axios.get("api/get-all")
    //         .then((response) => {
    //             return response.data.data;
    //         })
    //         .catch((error) => {
    //             console.log(error);
    //         });
    // },
    getResults(page = 1) {
        return axios.get('api/get-all?page=' + page)
            .then(response => {
                return response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
    }
}
