<template>
    <div>
        <!-- <div class="circle">
            <div class="circle2"></div>
        </div> -->
    <div class="container-fluid m-5">
        <!-- title - Nome Appartamento --> 
        <h1 class="front_show">{{ apartmentDet.title }}</h1>
        <div class="front_show">{{ apartmentDet.description }}</div>

        <img
            class="card-img-top"
            :src="'	http://127.0.0.1:8000/storage/' + apartmentDet.cover"
            alt="Dummy Image"
        />

        <div id="map" class="ms-auto map"></div>

        <div class="secondary-infos">
            <div class="my-tags">
                <i class="fa-solid fa-caret-right"></i>
                <span>Tags:</span>

                <div class="d-flex">
                    <div
                        class="tags-class"
                        v-for="tag of apartmentDet.tags"
                        :key="tag.id"
                    >
                        <img :src="tag.icon" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div v-if="apartmentDet.id" class="my-form">
            <contact-form :apartment_id="apartmentDet.id"></contact-form>
        </div>
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
    },
    mounted() {
        this.decodeApartment();
        this.showMap();
    },
};
</script>

<style lang="scss" scoped>
/* Show - map style */
#map {
    width: 500px;
    height: 500px;
}

// #marker {
//   background-image: url('/img/marker3.png');
//   background-size: cover;
//   width: 50px;
//   height: 70px;
// }
/* ---------------- */

// h1 {
//     color: rgb(14, 126, 231);
// }
img {
    margin: 40px auto;
    width: 500px;
}
.secondary-infos {
    margin-top: 30px;
    // .my-tags {
    //     display: flex;
    //     align-items: baseline;
    //     font-size: 0.8rem;
    //     margin-bottom: 8px;
    //     span {
    //         font-weight: 600;
    //         margin: 0 4px;
    //     }
    //     .tags-class {
    //         color: white;
    //         padding: 0 5px;
    //         border-radius: 5px;
    //     }

    //     .tags-class {
    //         margin: 0 3px;
    //         background-color: rgb(14, 126, 231);
    //     }
    // }
}
</style>
