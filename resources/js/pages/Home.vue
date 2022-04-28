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
      <h2>Hai poco <br> budget?</h2>
      <button class="button_forward d-flex align-items-center mt-5 py-2 px-4"><router-link class=" text-white" aria-current="page" :to="{ name: 'apartments.index' }">Destinazioni low-cost</router-link> <img class="ps-2" src="/img/frecce.svg" alt=""></button>
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
export default {

}
</script>

<style>
</style>