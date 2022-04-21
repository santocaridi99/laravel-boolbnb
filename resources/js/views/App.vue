<template>
    <div>
        <TheNavbar @clicked="onClickChild"></TheNavbar>

        <router-view></router-view>

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
            callbackLuoghi: [],
        };
    },
    methods: {
        onClickChild(value) {
            this.callbackLuoghi = value;
            console.log(value);
            console.log(this.callbackLuoghi, "questi sono i luoghi");
        },

        getStoredUser() {
            const storedUser = localStorage.getItem("user");
            if (storedUser) {
                this.user = JSON.parse(storedUser);
            } else {
                this.user = null;
            }
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
