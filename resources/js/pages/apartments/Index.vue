<template>
  <div>
    <div class="fixed-top black_banner d-flex flex-column justify-content-center align-items-center">  
      <div class="search_container text-center d-flex align-items-center justify-content-center">
        <!-- searchbar -->
        <input
          name="search"
          type="text"
          class="search_bar ps-3"
          placeholder="Inserisci la via [Premi Invio]"
          v-model="search"
          @keydown.enter="searchSubmit"
        />
        <button class="button_search_bar ms-2" @click="filterApartments()"><i class="fas fa-search"></i></button>
        <button class="filter_button ms-2"> <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none"><path stroke="#fff" stroke-linecap="round" stroke-width="1.5" d="M6 8.746h12M6 15.317h12"/><circle cx="7.5" cy="8.746" r="1.5" fill="#fff" stroke="#fff" stroke-width="1.5" style="animation:slide 1.5s cubic-bezier(.86,0,.07,1) infinite alternate both"/><circle cx="16.5" cy="15.254" r="1.5" fill="#fff" stroke="#fff" stroke-width="1.5" style="animation:slide-2 1.5s cubic-bezier(.86,0,.07,1) infinite alternate both"/></svg></button>
      </div>
  </div>

  <div class="container custom_container mt-5">

    <!-- title - Ricerca --> 
    <div class="title_back my-5 text-center fw-bold">
      <h1>{{this.search}}
        <h1 class="title_front mt-4">{{this.search}}</h1>
      </h1> 
    </div>

  </div>

    <!-- cards -->
    <!-- <div
      class="d-flex d-flex justify-content-center align-items-center flex-wrap"
    > -->
      <!-- <ApartmentCard></ApartmentCard>
            <div v-if="singleLocation !== null">
                {{ singleLocation.address.freeformAddress }}
            </div> -->

      <div class="container-fluid">
        <div></div>
        <div
          v-for="apartment of apartments"
          :key="apartment.id"
          class="apartment-card mt-5"
        >
          <!--  <div>{{ apartment.title }}</div>
                    <div
                        class="tags-class d-flex"
                        v-for="tag of apartment.tags"
                        :key="tag.id"
                    >
                        {{ tag.name }}
                    </div> -->

          <div class="flat_cover">
            <img
              :src="apartment.cover"
              alt="Dummy Image"
            />
            
            <div class="card_bg">
              <h3>{{ apartment.title }}</h3>
              <p>
                {{ apartment.description }}
              </p>
              <h5>Cosa troverai:</h5>
              <div class="d-flex">
                <div
                  class="tags-class me-1"
                  v-for="tag of apartment.tags"
                  :key="tag.id"
                >
                 
                  {{ tag.name }}
                </div>
              </div>
              <button class="button_forward d-flex align-items-center mt-4 px-4"><router-link class="text-white" :to="`/apartments/${apartment.slug}`">Scopri <img class="ps-2" src="/img/frecce.svg" alt=""></router-link></button>
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
      search:'',
    };
  },
  methods: {
    // assegnavo valore di default alla pagina 1
    decodeApartmentsJson(page = 1,search=null) {
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
            filter:search,
          },
        })
        .then((resp) => {
          this.pagination = resp.data;
          this.apartments = resp.data.data;
        });
    },
    filterApartments() {
      this.apartments.forEach((element) => {
        let distance = Math.sqrt(
          Math.pow(this.singleLocation.position.lat - element.latitude, 2) +
            Math.pow(this.singleLocation.position.lon - element.longitude, 2)
        );
        let realDistance = distance * 0.996 * 100;
        console.log(realDistance, " km, sono la prima prova");
        if (realDistance <= 20) {
          this.nearbyApartment = element;
        }
      });
      console.log(this.nearbyApartment);
    },
    searchSubmit() {
      // sfrutto postapi
      //parto da  pagina 1 e secondo argomento
      this.decodeApartmentsJson(1, this.search);
    },
  },
  mounted() {
    this.decodeApartmentsJson();
    // this.filterApartments(this.singleLocation.position.lat, this.singleLocation.position.lon)
  },
};
</script>

<style></style>
