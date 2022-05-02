<template>
<div>
  <div class="triangle"></div>
  <div class="triangle2"></div>

 <!-- button - cerca gli alloggi  -->
  <div class="fixed-top black_banner d-flex flex-column justify-content-center align-items-center">  
    <div class="search_container text-center d-flex align-items-center justify-content-center">
        <button class="button_forward d-flex align-items-center py-2 px-4"><router-link class=" text-white" aria-current="page" :to="{ name: 'apartments.index' }">Cerca gli alloggi</router-link> <img class="ps-2" src="/img/frecce.svg" alt=""></button>
    </div>
  </div>
  
  <div class="container custom_container mt-5">

    <!-- title - Consigliati per te --> 
    <div class="title_back my-5 text-center fw-bold">
      <h1>Consigliati per te
        <h1 class="title_front mt-4">Consigliati per te</h1>
      </h1> 
    </div>

    <!-- carousel -->
    
    <div class="d-flex justify-content-center align-items-center">
      <div v-if="apartments.length" class="box-slide">
           
          <div class="container d-flex justify-content-center align-items-center">
             <!-- funzione al click della freccia -->
          <i @click="prevImage" class="text-white arrow fas fa-chevron-left"></i>
            <div class="slider_container" @click="goToShow(apartments[currentIndex].slug)">
                <img class="slider_img" :src="apartments[currentIndex].cover" alt="random-image" @mouseover="resetAutoPlay" @mouseleave="restartAutoPlay" />
                <div class="slider_text d-flex flex-column justify-content-center">
                  <h4>{{apartments[currentIndex].title}}</h4>
                  <p>{{apartments[currentIndex].description}}</p>
                  <p>prezzo: <strong>{{apartments[currentIndex].price_per_night}} &euro;</strong></p>
                </div>
              <div class="dot-position">
              <!-- v-for: crea un pallino per ogni immagine in images    |    se currentIndex è uguale all'indice dell'immagine attiva la classe active (pallino bianco), altrimenti attiva disable -->
                <i v-for="(apartment, i) in apartments" :key="i" class="fas fa-circle dot-space" :class="currentIndex === i ? 'active' : 'disable'" @click="currentIndex = i"></i>
              </div>
            </div>
            <!-- funzione al click della freccia -->
           <i @click="nextImage" class="text-white arrow fas fa-chevron-right"></i>
          </div>          
          
      </div>
    </div>

  </div>

  <!-- banner -->
    <div class="container-fluid d-flex align-items-center custom_cont_fluid mt-5">
    <!-- <img src="/img/mountains-banner.png" alt=""> -->
      <div class="banner_text">
      <h2 class="mb-4">Hai poco <br> budget?</h2>
      <!-- <img class="img_banner" src="/img/boolbnb.svg" alt=""> -->
      <span class="align-bottom"> <h4><strong> Filtra le tue destinazioni per prezzo! </strong></h4> </span>
      <button class="button_forward d-flex align-items-center mt-4 py-2 px-4"><router-link class=" text-white" aria-current="page" :to="{ name: 'apartments.index' }">Destinazioni</router-link> <img class="ps-2" src="/img/frecce.svg" alt=""></button>
      </div>
    </div>
  
    <div class="container custom_container mt-5">

      <!-- title - Ispirazioni -->
      <div class="title_back text-center fw-bold">
        <h1>Ispirazioni
        <h1 class="title_front mt-4">Ispirazioni</h1>
        </h1> 
      </div>

      <div class="row my-4 ispirations align-items-end">
        <a href="http://127.0.0.1:8000/apartments/Appartamento-a-torino-5" class="city col-sm-12 col-md-6 col-lg-3">
          <img src="/img/torino.svg" alt="Milan" title="Torino">
          <div class="city_badge badge bg-warning text-dark">TORINO</div>
        </a>
        <a href="http://127.0.0.1:8000/apartments/Appartamento-a-roma-5" class="city col-sm-12 col-md-6 col-lg-3" >
          <img src="/img/roma.svg" alt="Rome" title="Roma">
          <div class="city_badge badge bg-warning text-dark">ROMA</div>
        </a>
        <a href="http://127.0.0.1:8000/apartments/Appartamento-a-firenze-5" class="city col-sm-12 col-md-6 col-lg-3">
          <img src="/img/firenze.svg" alt="Milan" title="Firenze">
          <div class="city_badge badge bg-warning text-dark">FIRENZE</div>
        </a>
        <a href="http://127.0.0.1:8000/apartments/Appartamento-a-milano-2" class="city col-sm-12 col-md-6 col-lg-3">
          <img src="/img/milano.svg" alt="Milan" title="Milano">
          <div class="city_badge badge bg-warning text-dark">MILANO</div>
        </a>                
      </div>

    </div>

  </div>
</template>

<script>
import axios from "axios";

export default {
    components: {
    },
    props: {
        singleLocation: Object,
    },
    data() {
        return {
          currentIndex: 0,
          timer: 0,
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
                            this.apartments = resp.data.data;
                            console.log(this.apartments, "sono apartments");
                            });
                return resp;
            } catch (e) {
                console.log(
                    "catturato errore , magari la città non è prensete nel db  " +
                        e.message
                );
            }
        },
        // funzione per scorrere le immagini incrementando il contatore (se il contatore arriva all'ultima immagine riparte da zero)
        nextImage() {
          this.currentIndex++;
          if (this.currentIndex > this.apartments.length - 1) {
            this.currentIndex = 0;
          }
        },
        // funzione per scorrere le immagini decrementando il contatore (se il contatore arriva a zero riparte dall'ultima immagine)
        prevImage() {
          this.currentIndex--;
          if (this.currentIndex < 0) {
            this.currentIndex = this.apartments.length - 1;
          }
        },
        autoplay() {
          this.timer = setInterval( () => {
            this.nextImage();
          }, 3000);
        },
        resetAutoPlay() {
          clearInterval(this.timer);
          
        },
        restartAutoPlay() {
          this.autoplay();
        },
        goToShow(link){
          location.href= "http://127.0.0.1:8000/apartments/" + link;
        }
      },
    mounted() {
      this.autoplay(),
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

<style>
</style>
