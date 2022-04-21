<template>
    <div class="m-5">
        <h1>{{ apartmentDet.title }}</h1>
        <div>{{ apartmentDet.description }}</div>

        <img
            class="card-img-top"
            :src="'	http://127.0.0.1:8000/storage/' + apartmentDet.cover"
            alt="Dummy Image"
        />

        <div id="map" class="map"></div>

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
                        {{ tag.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import tt from "@tomtom-international/web-sdk-maps";

export default {
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
                container: "map",
                center: this.coords,
                zoom: 16,
            });

            this.showMarker();
        },

        async showMarker() {
            await this.decodeApartment();
            let marker = new tt.Marker().setLngLat(this.coords).addTo(this.map);
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
/* ---------------- */

h1 {
    color: rgb(14, 126, 231);
}
img {
    margin: 40px auto;
    width: 700px;
    height: 350px;
}
.secondary-infos {
    margin-top: 30px;
    .my-tags {
        display: flex;
        align-items: baseline;
        font-size: 0.8rem;
        margin-bottom: 8px;
        span {
            font-weight: 600;
            margin: 0 4px;
        }
        .tags-class {
            color: white;
            padding: 0 5px;
            border-radius: 5px;
        }

        .tags-class {
            margin: 0 3px;
            background-color: rgb(14, 126, 231);
        }
    }
}
</style>
