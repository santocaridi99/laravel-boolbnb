<template>
    <div>
        <TheNavbar @clicked='updateTestLuoghi'></TheNavbar>

        <router-view :provaluoghi="testluoghi"></router-view>

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
            testluoghi:null,
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
        updateTestLuoghi(val){
            this.testluoghi=val;

        }
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
