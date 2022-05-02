<template>
    <div>
        <div class="circle">
            <div class="circle2"></div>
        </div>

        <div
            class="fixed-top black_banner d-flex flex-column justify-content-center align-items-center"
        >
            <div
                class="search_container text-center d-flex align-items-center justify-content-center"
            >
                <!-- searchbar -->
                <input
                    name="search"
                    type="text"
                    class="search_bar ps-3"
                    placeholder="Inserisci l'indirizzo"
                    v-model="search"
                    @keyup="searchBox"
                    @keyup.delete="autocompleteReset"
                />
                <button
                    class="button_search_bar ms-2"
                    @click="searchSubmit(), toggleAutocomplete()"
                >
                    <i class="fas fa-search"></i>
                </button>
                <button v-if="!show" class="filter_button ms-2" @click="showFilters">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none"><path stroke="#fff" stroke-linecap="round" stroke-width="1.5" d="M6 8.746h12M6 15.317h12"/> <circle cx="7.5" cy="8.746" r="1.5" fill="#fff" stroke="#fff" stroke-width="1.5" style=" animation: slide 1.5s cubic-bezier(0.86, 0, 0.07, 1) infinite alternate both;"/><circle cx="16.5" cy="15.254" r="1.5" fill="#fff" stroke="#fff" stroke-width="1.5" style="animation: slide-2 1.5s cubic-bezier(0.86, 0, 0.07, 1) infinite alternate both;"/></svg>
                </button>
                <button v-else class="filter_button ms-2" @click="showFilters">
                     <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"><rect width="16" height="16" x="4" y="4" stroke="#fff" stroke-width="1.5" rx="2.075"/><path fill="#fff" d="M10.242 9.18a.75.75 0 00-1.061 1.062l1.79 1.79-1.79 1.79a.75.75 0 001.06 1.06l1.79-1.79 1.79 1.79a.75.75 0 001.062-1.06l-1.79-1.79 1.79-1.79a.75.75 0 10-1.061-1.061l-1.79 1.79-1.79-1.79z" style="animation:blink-1 2s steps(1,end) infinite both"/></svg>
                </button>
            </div>

            <div
                v-if="luoghi.length !== 0"
                class="box p-2"
                :class="autocomplete ? 'hide' : ''"
            >
                <div
                    v-for="(luogo, i) in luoghi"
                    :key="luogo + i"
                    class="my-autocomplete p-2"
                >
                    <div @click="clickSearch(luogo.address.freeformAddress)">
                        {{ luogo.address.freeformAddress }}
                    </div>
                </div>
            </div>

            <!-- <button class="col-2" @click="getRadiusApartments()">
    Filtra gli appartamenti
</button> -->
            <div class="m-5 text-white d-lg-flex" v-if="show">
                <div class="">
                    <input
                        class="input_bar m-2"
                        type="number"
                        name="rooms"
                        v-model="rooms"
                        placeholder="rooms"
                        @change="searchSubmit"
                    />
                    <input
                        class="input_bar m-2"
                        type="number"
                        name="beds"
                        v-model="beds"
                        placeholder="beds"
                        @change="searchSubmit"
                    />
                    <input
                        class="input_bar m-2"
                        type="number"
                        name="price"
                        v-model="price"
                        placeholder="price"
                        @change="searchSubmit"
                    />
                    <div class="d-flex align-items-center ms-2">
                        <input
                            class=""
                            type="range"
                            min="10"
                            max="150"
                            v-model="radius"
                            step="10"
                            
                        />
                        <input
                            type="number"
                            class="my-input-num"
                            v-model="radius"
                            disabled
                        /> <span class="km">km</span> 
                    </div>
                </div>
                <div class="">
                    <input
                        type="checkbox"
                        id="1"
                        value="1"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="1">Piscina</label>
                    <br />
                    <input
                        type="checkbox"
                        id="2"
                        value="2"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="2">Cortile</label>
                    <br />
                    <input
                        type="checkbox"
                        id="three"
                        value="3"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="3">Colazione incluse</label>
                    <br />
                    <input
                        type="checkbox"
                        id="4"
                        value="4"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="4">Vista mare</label>
                    <br />
                    <input
                        type="checkbox"
                        id="5"
                        value="5"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="5">Posto auto</label>
                    <br />
                    <input
                        type="checkbox"
                        id="6"
                        value="6"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="6">Ingresso privato</label>
                    <br />
                    <input
                        type="checkbox"
                        id="7"
                        value="7"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="7">Patio o balcone</label>
                    <br />
                    <input
                        type="checkbox"
                        id="8"
                        value="8"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="8">TV</label>
                    <br />
                    <input
                        type="checkbox"
                        id="9"
                        value="9"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="9">Wi-fi</label>
                    <br />
                    <input
                        type="checkbox"
                        id="10"
                        value="10"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="10">Riscaldamenti</label>
                    <br />
                    <input
                        type="checkbox"
                        id="11"
                        value="11"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="11">Aria condizionata</label>
                    <br />
                    <input
                        type="checkbox"
                        id="12"
                        value="12"
                        v-model="picked"
                        name="picked[]"
                        @change="searchSubmit"
                    />
                    <label for="12">Vicino al centro</label>
                    <br />
                    
                </div>
            </div>
        </div>
        <!-- appartamenti -->
        <div class="back_ap">
            <div class="ap_card">
                <div class="row flat_row g-0">
                    <div
                        class="col-xxl-3 col-lg-4 col-md-6 col-sm-12 px-3 mb-4 d-flex align-items-stretch"
                        v-for="apartment of apartments"
                        :key="apartment.id"
                    >
                        <div class="flat pb-5">
                            <div class="button_rel d-flex align-items-center justify-content-between py-2 px-4">
                                <h5 class="p-0 m-0">prezzo: <strong>{{apartment.price_per_night}} &euro;</strong></h5>
                                 <button
                                class="button_forward "
                            >
                                <router-link
                                    target="_blank"
                                    class="text-white"
                                    :to="`/apartments/${apartment.slug}`"
                                    >Scopri
                                    <img
                                        class="ps-1"
                                        src="/img/frecce.svg"
                                        alt=""
                                /></router-link>
                            </button>

                            </div>
                           

                            <router-link
                                class="w-100 ex"
                                :to="`/apartments/${apartment.slug}`"
                            >
                                <img
                                    v-if="
                                        apartment.cover ===
                                        'http://127.0.0.1:8000/storage/cover'
                                    "
                                    class="card-img-top"
                                    src="https://fakeimg.pl/350x200/?text=Scarpe"
                                    alt="Flat Cover"
                                />
                                <img
                                    class="card-img-top"
                                    v-else
                                    :src="apartment.cover"
                                    alt="Flat Cover"
                                />
                            </router-link>

                            <div class="ap_body">
                                <!-- titolo -->
                                <div class="py-3 px-3 w-100 blk_op_bg">
                                    <div class="ap_title me-2 ms-3 text-break">
                                        <h2 class="fw-bold">
                                            <router-link
                                                class="white_font title_a"
                                                :to="`/apartments/${apartment.slug}`"
                                            >
                                                {{ apartment.title }}
                                            </router-link>
                                        </h2>

                                        <p class="text-white mb-3 op f_12">
                                            <i
                                                class="fas fa-map-marker-alt me-1"
                                            ></i>
                                            {{ apartment.streetAddress }}
                                        </p>

                                        <small>
                                            <!-- stanze -->
                                            <span
                                                v-if="
                                                    apartment.room_numbers === 1
                                                "
                                                class="text-white"
                                            >
                                                {{ apartment.room_numbers }}
                                                stanza &#10022;
                                            </span>
                                            <span v-else class="text-white">
                                                {{ apartment.room_numbers }}
                                                stanze &#10022;
                                            </span>
                                            <!-- letti -->
                                            <span
                                                v-if="
                                                    apartment.bed_numbers === 1
                                                "
                                                class="text-white"
                                            >
                                                {{ apartment.bed_numbers }}
                                                letto &#10022;
                                            </span>
                                            <span v-else class="text-white">
                                                {{ apartment.bed_numbers }}
                                                letti &#10022;
                                            </span>
                                            <!-- bagni -->
                                            <span
                                                v-if="
                                                    apartment.bathroom_numbers ===
                                                    1
                                                "
                                                class="text-white"
                                            >
                                                {{ apartment.bathroom_numbers }}
                                                bagno &#10022;
                                            </span>
                                            <span v-else class="text-white">
                                                {{ apartment.bathroom_numbers }}
                                                bagni &#10022;
                                            </span>
                                            <!-- mq -->
                                            <span class="text-white">
                                                {{ apartment.square_meters }} mq
                                            </span>
                                        </small>
                                    </div>
                                </div>

                                <!-- {{-- tags --}} -->
                                <div class="text-center mb-4 py-4 pt-3">
                                    <!-- {{-- icons --}} -->
                                    <span
                                        class="tags_class px-2"
                                        v-for="tag of apartment.tags"
                                        :key="tag.id"
                                    >
                                        <img
                                            :src="tag.icon"
                                            :alt="tag.name"
                                            :title="tag.name"
                                        />
                                    </span>
                                </div>

                                <!-- {{-- descrizione --}} -->
                                <!-- <h5 class="px-3">Su questo annuncio:</h5>
                                    <p
                                        class="ap_text font-monospace lh-base overflow-hidden mb-0 px-3 h_100 op_9"
                                    >
                                        {{ apartment.description }}
                                    </p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            autocomplete: false,
            show: false,
            apartments: [],
            pagination: {},
            nearbyApartment: [],
            newApartments: [],
            search: "",
            picked: [],
            luoghi: [],
            lat: null,
            long: null,
            rooms: null,
            beds: null,
            price: null,
            radius: 20,
        };
    },
    methods: {
        // assegnavo valore di default alla pagina 1
        async decodeApartmentsJson(
            page = 1,
            search = null,
            rooms = "*",
            beds = "*",
            price = null,
            picked = [],
            radius = 20
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
            try {
                const resp = await axios
                    .get("/api/apartments", {
                        params: {
                            page,
                            filter: search,
                            rooms: rooms,
                            beds: beds,
                            price: price,
                            picked: picked,
                            radius: radius,
                        },
                    })
                    .then((resp) => {
                        if (!search) {
                            console.log(resp.data.data, "sono resp.data.data");
                            this.pagination = resp.data;
                            console.log(this.pagination);
                            this.apartments = resp.data.data;
                            console.log(this.apartments, "sono apartments");
                        } else {
                            console.log(resp.data.data, "sono resp.data.data");
                            this.pagination = resp;
                            console.log(this.pagination);
                            this.apartments = resp.data;
                            console.log(this.apartments, "sono apartments");
                        }
                    });
                return resp;
            } catch (e) {
                console.log(
                    "catturato errore , magari la città non è prensete nel db  " +
                        e.message
                );
            }
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
        // getRadiusApartments(page = 1, search = null) {
        //   if (page < 1) {
        //     page = 1;
        //   }
        //   if (page > this.pagination.last_page) {
        //     page = this.pagination.last_page;
        //   }
        //   axios
        //     .get("/api/apartmentsInRadius", {
        //       params: {
        //         page,
        //         filter: search,
        //       },
        //     })
        //     .then((resp) => {
        //       this.newApartments = resp.data.data;
        //       console.log(this.newApartments);
        //     });
        // },
        clickSearch(luogo) {
            this.search = luogo;
            this.searchBox();
            this.toggleAutocomplete();
        },
        // filterApartments() {
        //     this.apartments.forEach((element) => {
        //         let distance = Math.sqrt(
        //             Math.pow(
        //                 this.singleLocation.position.lat - element.latitude,
        //                 2
        //             ) +
        //                 Math.pow(
        //                     this.singleLocation.position.lon -
        //                         element.longitude,
        //                     2
        //                 )
        //         );
        //         let realDistance = distance * 0.996 * 100;
        //         console.log(realDistance, " km, sono la prima prova");
        //         if (realDistance <= 20) {
        //             this.apartments = element;
        //         }
        //     });
        //     console.log(this.nearbyApartment);
        // },
        searchSubmit() {
            // sfrutto postapi
            //parto da  pagina 1 e secondo argomento
            this.decodeApartmentsJson(
                1,
                this.search,
                this.rooms,
                this.beds,
                this.price,
                this.picked,
                this.radius
            );
        },
        showFilters() {
            return (this.show = !this.show);
        },
        toggleAutocomplete() {
            this.autocomplete = true;
        },
        autocompleteReset() {
            if (this.search === "") {
                this.autocomplete = false;
            }
        },
    },
    mounted() {
        this.decodeApartmentsJson(
            1,
            this.search,
            this.rooms,
            this.beds,
            this.price,
            this.picked,
            this.radius
        );
        // this.filterApartments(this.singleLocation.position.lat, this.singleLocation.position.lon)
    },
};
</script>

<style lang="scss" scoped></style>
