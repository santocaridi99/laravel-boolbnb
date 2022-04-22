<template>
    <div class="container">
        <!-- lista degli appartamenti filtrati -->
        <h1 class="my-4 text-center">Qui lista filtrata degli appartamenti</h1>
        <div class="d-flex">
            <input
                name="search"
                type="text"
                class="form-input col-5"
                placeholder="Filtra post [Premi Invio]"
                v-model="search"
                @keydown="searchBox"
                @keydown.enter="searchSubmit"
                @keyup.enter="getRadiusApartments"
            />
            <button class="col-2" @click="getRadiusApartments()">
                Filtra gli appartamenti
            </button>
        </div>
        <div class="d-flex m-3">
            <input
                type="number"
                name="rooms"
                v-model="rooms"
                @keydown.enter="searchSubmit"
            />

            <input
                type="number"
                name="beds"
                v-model="beds"
                @keydown.enter="searchSubmit"
            />

            <input
                type="radio"
                id="one"
                value="1"
                v-model="picked"
                @change="searchSubmit"
            />
            <label for="one">Uno</label>
            <br />
            <input
                type="radio"
                id="two"
                value="2"
                v-model="picked"
                @change="searchSubmit"
            />
            <label for="two">Due</label>
            <br />
            <input
                type="radio"
                id="three"
                value="3"
                v-model="picked"
                @change="searchSubmit"
            />
            <label for="three">Tre</label>
            <br />
        </div>
        <div v-if="luoghi.length !== 0" class="box">
            <div
                v-for="(luogo, i) in luoghi"
                :key="luogo + i"
                class="my-autocomplete"
            >
                <div @click="clickSearch(luogo.address.freeformAddress)">
                    {{ luogo.address.freeformAddress }}
                </div>
            </div>
        </div>
        <!-- cards -->
        <div
            class="d-flex d-flex justify-content-center align-items-center flex-wrap"
        >
            <!-- <ApartmentCard></ApartmentCard>
            <div v-if="singleLocation !== null">
                {{ singleLocation.address.freeformAddress }}
            </div> -->

            <div class="my-card-cont d-flex">
                <div
                    v-for="apartment of apartments"
                    :key="apartment.id"
                    class="apartment-card m-4"
                >
                    <!--  <div>{{ apartment.title }}</div>
                    <div
                        class="tags-class d-flex"
                        v-for="tag of apartment.tags"
                        :key="tag.id"
                    >
                        {{ tag.name }}
                    </div> -->

                    <div class="card" style="width: 18rem">
                        <img
                            class="card-img-top"
                            :src="apartment.cover"
                            alt="Dummy Image"
                        />
                        <div class="card-body">
                            <h5 class="card-title">{{ apartment.title }}</h5>
                            <p class="card-text">
                                {{ apartment.description }}
                            </p>

                            <div class="d-flex">
                                <div
                                    class="tags-class me-1"
                                    v-for="tag of apartment.tags"
                                    :key="tag.id"
                                >
                                    {{ tag.name + " - " }}
                                </div>
                            </div>
                            <!--  <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- <nav>
                <ul class="my-pages">
                    <li v-for="page in pagination.last_page" :key="page">
                        <a class="my-page-link" @click="decodePostJson(page)">
                            {{ page }}
                        </a>
                    </li>
                </ul>
            </nav> -->
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
            nearbyApartment: [],
            newApartments: [],
            search: "",
            picked: null,
            luoghi: [],
            lat: null,
            long: null,
            rooms: null,
            beds: null,
        };
    },
    methods: {
        // assegnavo valore di default alla pagina 1
        decodeApartmentsJson(
            page = 1,
            search = null,
            rooms = "*",
            beds = "*",
            picked = null
        ) {
            if (page < 1) {
                page = 1;
            }
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            /*  axios.get("/api/posts").then((resp) => {
                this.postToPrint = resp.data;
            }); */
            axios
                .get("/api/apartments", {
                    params: {
                        page,
                        filter: search,
                        rooms: rooms,
                        beds: beds,
                        picked: picked,
                    },
                })
                .then((resp) => {
                    this.pagination = resp.data;
                    this.apartments = resp.data.data;
                });
        },
        async searchBox() {
            if (this.search.length >= 2) {
                const result = await axios
                    .get(
                        `https://api.tomtom.com/search/2/geocode/${this.search}.json?storeResult=false&limit=5&countrySet=it&radius=5&view=Unified&key=Z4C8r6rK8x69JksEOmCX43MGffYO83xu`
                    )
                    .then((res) => {
                        this.luoghi = res.data.results;
                        if (this.luoghi.length > 0) {
                            let coords = this.luoghi[0].position;
                            this.lat = coords.lat;
                            this.long = coords.lon;
                        }
                    });
                return result;
            } else {
                this.lat = null;
                this.long = null;
                this.luoghi = "";
            }
        },
        getRadiusApartments(page = 1, search = null) {
            if (page < 1) {
                page = 1;
            }
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            axios
                .get("/api/apartmentsInRadius", {
                    params: {
                        page,
                        filter: search,
                    },
                })
                .then((resp) => {
                    this.newApartments = resp.data.data;
                    console.log(this.newApartments);
                });
        },
        clickSearch(luogo) {
            this.search = luogo;
            this.searchBox();
        },
        filterApartments() {
            this.apartments.forEach((element) => {
                let distance = Math.sqrt(
                    Math.pow(
                        this.singleLocation.position.lat - element.latitude,
                        2
                    ) +
                        Math.pow(
                            this.singleLocation.position.lon -
                                element.longitude,
                            2
                        )
                );
                let realDistance = distance * 0.996 * 100;
                console.log(realDistance, " km, sono la prima prova");
                if (realDistance <= 20) {
                    this.apartments = element;
                }
            });
            console.log(this.nearbyApartment);
        },
        searchSubmit() {
            // sfrutto postapi
            //parto da  pagina 1 e secondo argomento
            this.decodeApartmentsJson(
                1,
                this.search,
                this.rooms,
                this.beds,
                this.picked
            );
        },
    },
    mounted() {
        this.decodeApartmentsJson();
        // this.filterApartments(this.singleLocation.position.lat, this.singleLocation.position.lon)
    },
};
</script>

<style lang="scss" scoped>
.box {
    background-color: white;
    .my-autocomplete {
        cursor: pointer;
        &:hover {
            background-color: rgba(152, 152, 246, 0.328);
        }
    }
}
</style>
