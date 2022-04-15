<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <!-- Nav -->
        <router-link class="navbar-brand" :to="{ name:'home.index' }">Navbar</router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- home -->
            <li class="nav-item">
              <router-link 
                class="nav-link active" aria-current="page"
                :to="{ name:'home.index' }"
                >
                  Home
              </router-link>
            </li>
            <!-- links -->
            <li class="nav-item">
              <router-link 
                class="nav-link active" aria-current="page"
                :to="{ name:'apartments.index' }"
                >
                  Alloggi
              </router-link>
            </li>
            <!-- dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>

            <!-- search bar -->
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </ul>

          <!-- login/register area -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown" v-if="!user">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Login / Register 
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/login">Login</a></li>
                <li><a class="dropdown-item" href="/register">Register</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown" v-else>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ user.name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/host">Logout</a></li>
                <li><a class="dropdown-item" href="/host/apartments">I miei appartamenti</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      routes: [],
      user: null,
    };
  },
  methods: {
    fetchUser() {
      // recuperiamo l'utente loggato tramite api
      axios
        .get("/api/user")
        .then((resp) => {
          // Nel caso in cui sia loggato, riceviamo i dettagli dell'utente
          // li salviamo in una variabile locale.
          this.user = resp.data;
          // All'interno del localStorage, salviamo i dettagli dell'utente
          localStorage.setItem("user", JSON.stringify(resp.data));
          // Per comunicare in tempo reale che l'utente loggato è cambiato,
          // lanciamo un evento custom su window
          window.dispatchEvent(new CustomEvent("storedUserChanged"));
        })
        .catch((er) => {
          // Entriamo nel catch SOLO se l'utente non è loggato e il server ci ritorna
          // un codice diverso da 200. Se non siamo loggati abbiamo un 401.
          console.error("Utente non loggato");
          // Nel caso di errore, cancelliamo i dettagli dell'utente dal localStorage
          localStorage.removeItem("user");
          // Per comunicare in tempo reale che l'utente loggato è cambiato,
          // lanciamo un evento custom su window
          window.dispatchEvent(new CustomEvent("storedUserChanged"));
        });
    },
  },
  mounted() {
    this.routes = this.$router
      .getRoutes()
      .filter((route) => !!route.meta.linkText);
    this.fetchUser();
    console.log(this.routes);
  },
};
</script>

<style>

</style>