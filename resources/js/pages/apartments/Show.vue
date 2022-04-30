<template>
    <div id="show" v-if="open === false">
        <!-- titolo e immagini -->
        <div class="container" > 
            <h1 class="front_show mb-4">{{ apartmentDet.title }}</h1> 
            <!-- img lg -->
            <div class="row g-0 img_lg"> 
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <img class="cover_img" :src="'http://127.0.0.1:8000/storage/' + apartmentDet.cover" alt="Flat cover"/>  
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="" v-for="(item, index) in apartmentDet.images" :key="index">
                        <img class="flat_pic w-100" :src="'/image/' + item.images" alt="Flat pic">
                    </div>
                </div>      
            </div>
            <!-- img md carousel -->
            <div class="img_md">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="cover_img d-block w-100" :src="'http://127.0.0.1:8000/storage/' + apartmentDet.cover" alt="Flat cover"/>  
                        </div>
                        <div class="carousel-item" v-for="(item, index) in apartmentDet.images" :key="index">
                            <img class="flat_pic d-block w-100" :src="'/image/' + item.images" alt="Flat pic">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- info appartamento -->
        <div class="container-fluid bg-light px-4 py-4">
            <div class="info_container align-items-center justify-content-center">
                <div class="row info_row align-items-start justify-content-center">

                    <div class="col-lg-7 col-md-12 d-flex flex-column align-items-start pe-5">
                        <h2 class="mb-2">{{apartmentDet.title}}</h2>
                        <small class="">
                            <i class="fas fa-map-marker-alt me-1 mb-5" ></i>
                            {{apartmentDet.streetAddress}}
                        </small>
                        <p class="mb-5">{{apartmentDet.description}}</p>
                        <div>
                            <span class="" v-for="tag of apartmentDet.tags" :key="tag.id">
                                <img class="tag_icon mb-5" :src="tag.icon" :alt="tag.name" :title="tag.name">  
                            </span>
                        </div> 
                        <small class="mb-4">
                            <!-- stanze -->
                            <span v-if="apartmentDet.room_numbers === 1">
                                &#10022;
                                {{ apartmentDet.room_numbers }}
                                stanza &#10022;
                            </span>
                            <span v-else>
                                &#10022;
                                {{ apartmentDet.room_numbers }}
                                stanze &#10022;
                            </span>
                            <!-- letti -->
                            <span v-if="apartmentDet.bed_numbers === 1">
                                {{ apartmentDet.bed_numbers }}
                                letto &#10022;
                            </span>
                            <span v-else>
                                {{ apartmentDet.bed_numbers }}
                                letti &#10022;
                            </span>
                            <!-- bagni -->
                            <span v-if="apartmentDet.bathroom_numbers === 1">
                                {{ apartmentDet.bathroom_numbers }}
                                bagno &#10022;
                            </span>
                            <span v-else>
                                {{ apartmentDet.bathroom_numbers }}
                                bagni &#10022;
                            </span>
                            <!-- mq -->
                            <span>
                                {{ apartmentDet.square_meters }} mq
                                &#10022;
                            </span>
                        </small>             
                    </div>

                    <div class="col-lg-5 col-md-12 d-flex flex-column align-items-start">
                        <div id="map" class="map mb-5"></div>
                        <h2 class="">prezzo: <strong> {{apartmentDet.price_per_night}} &euro; </strong></h2>            
                    </div>
                </div>
                
            </div>
            <div class="info_container align-items-center justify-content-center">
                <div class="row d-flex align-items-space-center justify-content-between">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <button class="button_back d-flex align-items-center px-3 my-2">
                            <router-link
                                class="text-white"
                                :to="{ name: 'apartments.index' }"
                                ><img class="ps-1" src="/img/frecce.svg" alt=""/>
                                Torna agli alloggi                                                                            
                            </router-link>
                        </button> 
                    </div>                        

                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <button class="button_forward d-flex align-items-center px-3 my-2" @click="toggleForm">
                            Contatta l'host  
                            <img class="ps-1" src="/img/frecce.svg" alt=""/>       
                        </button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- form contatti -->
    <div class="message_window d-flex flex-column align-items-center justify-content-start" v-else>
        <img class="loader mt-5" src="/img/bool_load.gif" alt="boolbnb">
            <div v-if="apartmentDet.id" class="my-form mx-5"> 
                <div class="x d-flex">
                    <div class="icon_x">
                        <i class=" fas fa-window-close" @click="reloadPage"></i>
                    </div>
                    <div class="x_text d-flex align-items-center">
                        <p class="p-0 m-0"> Chiudi </p>
                    </div>  
                </div>  
                <contact-form :apartment_id="apartmentDet.id"></contact-form>
            </div>
        </div>
</template>

<script>

import axios from "axios";
import tt from "@tomtom-international/web-sdk-maps";
import ContactForm from "../../components/ContactForm.vue";

export default {
    components: { ContactForm },
    name: "Map",
    data() {
        return {
            apartmentDet: {},
            /*             lat: 0,
            lng: 0, */
            coords: [0, 0],
            map: null,
            open: false,
        };
    },
    methods: {
        async showMap() {
            await this.decodeApartment();

            this.map = tt.map({
                key: "Z4C8r6rK8x69JksEOmCX43MGffYO83xu",
                container:  'map',
                center: this.coords,
                zoom: 16,
            });

            this.showMarker();
        },

        async showMarker() {
            await this.decodeApartment();
            // let element = document.createElement('div');
            // element.id = 'marker';
            let marker = new tt.Marker().setLngLat(this.coords).addTo(this.map);

            var popupOffsets = {
                bottom: [0, -30],
            }
            let popup = new tt.Popup({offset: popupOffsets}).setHTML(this.apartmentDet.title);
            marker.setPopup(popup).togglePopup();
        },

        async decodeApartment() {
            try {
                const resp = await axios.get(
                    "/api/apartments/" + this.$route.params.apartment
                );
                this.apartmentDet = resp.data;
                /* this.lat = resp.data.latitude;
                this.lng = resp.data.longitude; */
                this.coords = [resp.data.longitude, resp.data.latitude];
            } catch (er) {
                this.$router.replace({ name: "ErrorPage" });
            }
        },
        toggleForm() {
            return this.open= !this.open;
        },
        reloadPage(){
            window.location.reload();
        },
    },
    mounted() {
        this.decodeApartment();
        this.showMap();
    },
};
</script>

<style lang="scss" scoped>
/* Show - map style */
.map {
    width: 100%;
    height: 300px;
    border-radius: 25px;
    box-shadow: 0 0 15px 5px rgb(0 0 0 / 20%);
}

// #marker {
//   background-image: url('/img/marker3.png');
//   background-size: cover;
//   width: 50px;
//   height: 70px;
// }

</style>
