<template>
    <div class="container">
        <!-- lista degli appartamenti filtrati -->
        <h1 class="my-4 text-center">Qui lista filtrata degli appartamenti</h1>

        <!-- cards -->
        <div
            class="d-flex d-flex justify-content-center align-items-center flex-wrap"
        >
            <!-- <ApartmentCard></ApartmentCard>
            <div v-if="singleLocation !== null">
                {{ singleLocation.address.freeformAddress }}
            </div> -->

            <div class="my-card-cont">
                <div v-for="apartment of apartments" :key="apartment.id"></div>
            </div>
            <nav>
                <ul class="my-pages">
                    <li v-for="page in pagination.last_page" :key="page">
                        <a class="my-page-link" @click="decodePostJson(page)">
                            {{ page }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import ApartmentCard from "../../components/ApartmentCard.vue";
export default {
    components: {
        ApartmentCard,
    },
    props: {
        singleLocation: Object,
    },
    data() {
        return {
            apartments: [],
            pagination: {},
        };
    },
    methods: {
        // assegnavo valore di default alla pagina 1
        async decodeApartmentsJson(page = 1) {
            if (page < 1) {
                page = 1;
            }
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            /*  axios.get("/api/posts").then((resp) => {
                this.postToPrint = resp.data;
            }); */
            const resp = await axios.get("/api/apartments?page=" + page);
            this.pagination = resp.data;
            console.log(resp.data.data);
            this.apartments = resp.data.data;
        },
    },
    mounted() {
        this.decodeApartmentsJson();
    },
};
</script>

<style></style>
