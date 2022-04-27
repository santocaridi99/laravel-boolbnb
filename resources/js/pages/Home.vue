<template>
<div>
  <div class="triangle"></div>
  <div class="triangle2"></div>

 <!-- button - cerca gli alloggi  -->
  <div class="fixed-top black_banner d-flex flex-column justify-content-center align-items-center">  
    <div class="search_container text-center d-flex align-items-center justify-content-center">
        <button class="button_forward d-flex align-items-center px-4"><router-link class=" text-white" aria-current="page" :to="{ name: 'apartments.index' }">Cerca gli alloggi</router-link> <img class="ps-2" src="/img/frecce.svg" alt=""></button>
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

      <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        
        <div class="carousel-inner custom_carousel">
          <div class="carousel-item custom_slide active" data-bs-interval="10000">
            <img src="/img/roma2.jpg" class="d-block" alt="...">
            <div class="carousel-caption custom_text_carousel d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item custom_slide" data-bs-interval="10000">
            <img src="/img/venice.jpg" class="d-block" alt="...">
            <div class="carousel-caption custom_text_carousel d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item custom_slide" data-bs-interval="10000">
            <img src="/img/bosco.webp" class="d-block" alt="...">
            <div class="carousel-caption custom_text_carousel d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

  </div>

  <!-- banner -->
    <div class="container-fluid custom_cont_fluid mt-5">
    <!-- <img src="/img/mountains-banner.png" alt=""> -->
      <div class="banner_text">
      <h2>Sei <br> povero?</h2>
      <button class="button_forward d-flex align-items-center mt-5 px-4"><router-link class=" text-white" aria-current="page" :to="{ name: 'apartments.index' }">Consigliami</router-link> <img class="ps-2" src="/img/frecce.svg" alt=""></button>
      </div>
    </div>
  
    <div class="container custom_container mt-5">

      <!-- title - Ispirazioni -->
      <div class="title_back text-center fw-bold">
        <h1>Ispirazioni
        <h1 class="title_front mt-4">Ispirazioni</h1>
        </h1> 
      </div>

      <div class="row my-4 ispirations">
        <router-link :to="{ name:'apartments.index' }" class="col-sm-12 col-md-6 col-lg-4" >
          <img src="/img/colosseo.svg" alt="..." title="Rome">
        </router-link>
        <router-link :to="{ name:'apartments.index' }" class="col-sm-12 col-md-6 col-lg-4">
          <img src="/img/duomo-di-milano.svg" alt="..." title="Milan">
        </router-link>
        <router-link :to="{ name:'apartments.index' }" class="col-sm-12 col-md-6 col-lg-4">
          <img src="/img/torre-di-pisa.svg" alt="..." title="Pisa">
        </router-link>
      </div>

    </div>

  </div>
</template>

<script>
export default {

}
</script>

<style>
</style>