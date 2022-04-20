<template>
  <div>
    <TheNavbar
      @searchApartment="searchButton"
      :luoghi="this.luoghi"
    ></TheNavbar>

    <router-view></router-view>

    <TheFooter></TheFooter>


  </div>
</template>

<script>
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
      newquery: "",
      api_key: "Z4C8r6rK8x69JksEOmCX43MGffYO83xu",
      luoghi: [],
      flag: false,
      lat: null,
      long: null,
    }
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
    searchButton(query){
      this.searchBox(query)
    },
    async searchBox(query) {
      if (query.length >= 2) {
        const result = await axios
          .get(
            `https://api.tomtom.com/search/2/geocode/${query}.json?storeResult=false&limit=5&countrySet=it&radius=5&view=Unified&key=Z4C8r6rK8x69JksEOmCX43MGffYO83xu`
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
        this.luoghi='';
      }
    },
    clickSearch(luogo) {
      this.newquery = luogo;
      this.searchBox();
    },
  },
  mounted() {
     this.getStoredUser();

    window.addEventListener('storedUserChanged', () => {
      this.getStoredUser();
    });
  }
}
</script>

<style>

</style>