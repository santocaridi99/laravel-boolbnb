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
            <form class="d-flex" autocomplete="off">
              <div class="d-flex autocomplete">
                <input id="myFilter" class="form-control me-2" type="search" placeholder="Search" v-model="place" aria-label="Search" @keyup="filterApartments()" @keydown.enter="filterApartments()">
                <button class="btn btn-outline-light" @click="filterApartments()">Search</button>
              </div>
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
                {{ user.name }} {{ user.lastname }}
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
// import { services } from '@tomtom-international/web-sdk-services';
// import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

// const ttSearchBox = new SearchBox(services, options);
// const searchBoxHTML = ttSearchBox.getSearchBoxHTML();

export default {
  data() {
    return {
      routes: [],
      user: null,
      coordinates:[],
      places: [],
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
    filterApartments(){

      let address = this.place;
      let key = "m5upOBKh2ugQazsa72XgmQ7fFAuUxA9y";
        
        axios.get(`https://api.tomtom.com/search/2/geocode/${address}.json?storeResult=false&limit=5&countrySet=IT&radius=20000&language=it-IT&view=Unified&key=${key}`).
        then((response) => {
          response.data.places.forEach(element => {
            if(this.coordinates.length > 10){
                this.autocomplete(document.getElementById("myFilter"), this.coordinates)
                this.places.push(element.address.freeformAddress);
                this.coordinates.push(element.address.location);
                console.log(this.places)
                console.log(this.coordinates)
              } else{
                this.autocomplete(document.getElementById("myFilter"), this.coordinates)
                this.places.push(element.address.freeformAddress);
                this.coordinates.push(element.address.location);
                console.log(this.places)
                console.log(this.coordinates)
              }
              // console.log(this.coordinates)
            });
        })

    },
  autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        var a,
            b,
            i,
            val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
          return false;
        }
        
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("v-on:click", "filterApartments()");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
              console.log('sono dentro al for')
            // if (
            //     arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()
            // ) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML =
                    "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            // }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) {
            //up
            /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = x.length - 1;
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
  }
  },
  mounted() {
    this.routes = this.$router
      .getRoutes()
      // .filter((route) => !!route.meta.linkText);
    this.fetchUser();
    console.log(this.routes);
    this.tomtomApi;
  },
};
</script>

<style>
@import '/node_modules/@tomtom-international/web-sdk-plugin-searchbox/dist/SearchBox.css';
.autocomplete {
    position: relative;
    display: inline-block;
  }
  
  input {
    border: 1px solid transparent;
    background-color: #f1f1f1;
    padding: 10px;
    font-size: 16px;
  }
  
  input[type=text] {
    background-color: #f1f1f1;
    width: 100%;
  }
  
  input[type=submit] {
    background-color: DodgerBlue;
    color: #fff;
    cursor: pointer;
  }
  
  .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
  }
  
  .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff; 
    border-bottom: 1px solid #d4d4d4; 
  }
  
  /*when hovering an item:*/
  .autocomplete-items div:hover {
    background-color: #e9e9e9; 
  }
  
  /*when navigating through the items using the arrow keys:*/
  .autocomplete-active {
    background-color: DodgerBlue !important; 
    color: #ffffff; 
  }
</style>