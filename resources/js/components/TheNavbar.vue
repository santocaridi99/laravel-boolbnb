<template>
    <div>
        <nav class="fixed-top custom_nav d-flex align-items-center p-4">
            <!-- Navbar -->
            <router-link class="navbar-brand" :to="{ name:'home.index' }"><img src="/img/boolbnb.svg" alt=""></router-link>

            <ul class="custom_link d-flex align-items-center" v-if="user" >
            <!-- links -->
                <!-- I miei alloggi - desktop -->
                <li>
                    <a class="nav_text" aria-current="page" href="/host/apartments">I miei alloggi</a>
                </li>
                <!-- I miei alloggi - mobile -->
                <li>
                    <a class="nav_icon text-center" aria-current="page" href="/host/apartments">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"><g style="animation:slide-right 1s cubic-bezier(.75,.02,.2,1.06) infinite alternate both" stroke-width="1.5"><path stroke="#111" d="M17 10.193c0 2.867-4.5 8.307-5 8.307s-5-5.44-5-8.307C7 7.325 9.239 5 12 5s5 2.325 5 5.193z"/><circle cx="12" cy="10" r="2" stroke="#FF385C"/></g></svg>
                        <p class="nav_icon_text">I miei alloggi</p>
                    </a>
                </li>
                <!-- Nome utente - desktop -->
                <li>
                    <a class="nav_text" aria-current="page" href="/host">{{ user.name }}</a>
                </li>
                <!-- Nome utente - mobile -->
                <li>
                    <a class="nav_icon text-center" aria-current="page" href="/host">
                        <i class="icon fas fa-user-circle"></i>
                        <p class="nav_icon_text">{{ user.name }}</p>
                    </a>
                </li>
            </ul>
            <ul class="custom_link d-flex align-items-center" v-else>
                <!-- Accedi - desktop -->
                <li>
                    <a class="nav_text" aria-current="page"  href="/login">Accedi</a>
                </li>
                <!-- Accedi - mobile -->
                <li>
                    <a class="nav_icon text-center " aria-current="page" href="/login">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"><path fill="#FF385C" d="M15.236 10.811a.736.736 0 01-.736-.736V8.811a2.5 2.5 0 00-5 0v5H8v-5a4 4 0 018 0v1.236a.764.764 0 01-.764.764z" style="animation:lock 1s cubic-bezier(1,-.43,0,1.29) both infinite alternate-reverse"/><path fill="#fff" d="M6.6 13.704a3 3 0 013-3h4.8a3 3 0 013 3v3a3 3 0 01-3 3H9.6a3 3 0 01-3-3v-3z"/><path fill="#0A0A30" d="M9.6 11.454h4.8v-1.5H9.6v1.5zm7.05 2.25v3h1.5v-3h-1.5zm-2.25 5.25H9.6v1.5h4.8v-1.5zm-7.05-2.25v-3h-1.5v3h1.5zm2.25 2.25a2.25 2.25 0 01-2.25-2.25h-1.5a3.75 3.75 0 003.75 3.75v-1.5zm7.05-2.25a2.25 2.25 0 01-2.25 2.25v1.5a3.75 3.75 0 003.75-3.75h-1.5zm-2.25-5.25a2.25 2.25 0 012.25 2.25h1.5a3.75 3.75 0 00-3.75-3.75v1.5zm-4.8-1.5a3.75 3.75 0 00-3.75 3.75h1.5a2.25 2.25 0 012.25-2.25v-1.5zm1.543 5.198a.857.857 0 011.714 0v.104a.857.857 0 11-1.714 0v-.104z"/></svg>
                        <p class="nav_icon_text">Accedi</p>
                    </a>
                </li>
                <!-- Diventa un host - desktop -->
                <li>
                    <a class="nav_text" aria-current="page" href="/register">Diventa un host</a>
                </li>
                <!-- Diventa un host - mobile -->
                <li>
                    <a class="nav_icon text-center" aria-current="page" href="/register"><i class="icon fas fa-ghost"></i>
                        <p class="nav_icon_text">Diventa un host</p>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="fixed-top black_banner d-flex flex-column justify-content-center align-items-center">  
            <div class="search_container text-center d-flex align-items-center justify-content-center">
                <button class="button_forward d-flex align-items-center mt-5 px-4"><router-link class=" text-white" aria-current="page" :to="{ name: 'apartments.index' }">Alloggi</router-link> <img class="ps-2" src="/img/frecce.svg" alt="">

                <!-- search bar -->
                <input
                name="query"
                class="search_bar ps-3"
                placeholder="Dove vuoi andare?"
                v-model="query"
                @keyup="this.searchBox"/>
                <router-link
                :to="'/apartments'"
                class="button_search_bar ms-2"
                :class="[query === '' ? 'btnStop' : '']"
                @click.native="onClickButton()"
                >
                <i class="fas fa-search"></i>
                </router-link>
            </div>
            <div v-if="luoghi.length !== 0" class="box p-2">
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
        </div>
    </div>
</template>

<script>
import axios from "axios";
// import { services } from '@tomtom-international/web-sdk-services';
// import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

// const ttSearchBox = new SearchBox(services, options);
// const searchBoxHTML = ttSearchBox.getSearchBoxHTML();

export default {
    data() {
        return {
            isAllowed: false,
            user: null,
            routes: [],
            query: "",
            api_key: "Z4C8r6rK8x69JksEOmCX43MGffYO83xu",
            luoghi: [],
            lat: null,
            long: null,
        };
    },
    methods: {
        //Funzione che fa da emit per il passaggio del primo oggetto presente nell'array luoghi[] verso app.vue
        onClickButton() {
            this.$emit("clicked", this.luoghi[0]);
        },

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
                    // Nel caso di errore, cancelliamo i dettagli dell'utente dal localStorage
                    localStorage.removeItem("user");
                    // Per comunicare in tempo reale che l'utente loggato è cambiato,
                    // lanciamo un evento custom su window
                    window.dispatchEvent(new CustomEvent("storedUserChanged"));
                });
        },
        getStoredUser() {
            const storedUser = localStorage.getItem("user");
            if (storedUser) {
                this.user = JSON.parse(storedUser);
            } else {
                this.user = null;
            }
        },
        // searchbox
        async searchBox() {
            if (this.query.length >= 2) {
                const result = await axios
                    .get(
                        `https://api.tomtom.com/search/2/geocode/${this.query}.json?storeResult=false&limit=5&countrySet=it&radius=5&view=Unified&key=Z4C8r6rK8x69JksEOmCX43MGffYO83xu`
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
        clickSearch(luogo) {
            this.query = luogo;
            this.searchBox();
        },
    },
    mounted() {
        this.routes = this.$router.getRoutes();
        // .filter((route) => !!route.meta.linkText);
        this.fetchUser();
        console.log(this.routes);
    },
};
</script>

<style lang="scss" scoped>
.btnStop {
    cursor: not-allowed;
    pointer-events: none;
}
</style>
