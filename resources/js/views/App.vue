<template>
    <div>
        <TheNavbar @clicked="updateLocations"></TheNavbar>

        <router-view :singleLocation="callToLocations"></router-view>

        <TheFooter></TheFooter>
    </div>
</template>

<script>
/* import axios from "axios"; */
import TheNavbar from "../components/TheNavbar.vue";
import TheFooter from "../components/TheFooter.vue";

export default {
    components: {
        TheNavbar,
        TheFooter,
    },
    data() {
        return {
            user: null,
            callToLocations: null,
        };
    },
    methods: {
        getStoredUser() {
            const storedUser = localStorage.getItem("user");
            if (storedUser) {
                this.user = JSON.parse(storedUser);
            } else {
                this.user = null;
            }
        },

        //
        updateLocations(val) {
            this.callToLocations = val;
        },
    },
    mounted() {
        this.getStoredUser();

        window.addEventListener("storedUserChanged", () => {
            this.getStoredUser();
        });
    },
};
</script>

<style></style>
