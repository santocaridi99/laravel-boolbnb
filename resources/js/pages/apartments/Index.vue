<template>
  <div class="container">
    <!-- lista degli appartamenti filtrati -->
    <button @click="filterApartments()">Filtra gli appartamenti</button>
    <h1 class="my-4 text-center">Qui lista filtrata degli appartamenti</h1>
    <input
      name="search"
      type="text"
      class="form-input"
      placeholder="Filtra post [Premi Invio]"
      v-model="search"
      @keydown.enter="searchSubmit"
    />
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
