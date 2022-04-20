<template>
  <div class="container">
    <!-- title -->
    <h1 class="my-4 text-center">Ciao sono una homepage!</h1>

    <p class="text-center">Qui sotto preview sponsor</p>
    <!-- carousel -->
    <div class="d-flex justify-content-center align-items-center mt-2">
      <div id="carouselExampleDark" class="carousel carousel-dark slide w_500" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="https://cdn.dribbble.com/users/185738/screenshots/10637360/media/bd2ceb90ad7fec03d1f6943f5962dcc6.jpg" class="d-block w_500" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="https://cdn.dribbble.com/users/4570214/screenshots/9173798/media/caff21025ec5dd49d168b412e88f56d3.png" class="d-block w_500" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <!-- <h5>Second slide label</h5>
              <p>Some representative placeholder content for the second slide.</p> -->
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://cdn.dribbble.com/users/242721/screenshots/15318458/media/ece706ba65c6ddc1d1c0c94f6c6c4702.png" class="d-block w_500" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <!-- <h5>Third slide label</h5>
              <p>Some representative placeholder content for the third slide.</p> -->
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

    <!-- filtri per città -->
    <p class="text-center mt-4">Qui sotto ricerca filtrata per città</p>
    <div class="d-flex justify-content-center align-items-center my-2">
      <router-link :to="{ name:'apartments.index' }">
        <img src="https://cdn.dribbble.com/users/1437369/screenshots/10856751/media/a26397996de6e6a71bc7f1edb7fca474.png" class="rounded w_200" alt="..." title="Rome">
      </router-link>
      <router-link :to="{ name:'apartments.index' }">
        <img src="https://cdn.dribbble.com/users/589629/screenshots/3434795/media/b14303103ed76a02441f5b6cac180466.png" class="rounded w_200 mx-3" alt="..." title="Milan">
      </router-link>
      <router-link :to="{ name:'apartments.index' }">
        <img src="https://cdn.dribbble.com/users/2038748/screenshots/16540671/media/d3daee7531bd2f3e66aa6b690b9bc48c.jpg" class="rounded w_200" alt="..." title="Pisa">
      </router-link>
    </div>
  </div>
</template>

<script>

export default {
 
}
</script>

<style>

.w_500 {
  width: 500px;
}

.w_200 {
  width: 200px;
}
</style>