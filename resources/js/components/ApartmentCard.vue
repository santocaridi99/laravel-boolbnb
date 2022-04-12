<template>
  <div>
    <div class="card" style="width: 18rem;">
        <img src="https://cdn.dribbble.com/users/242721/screenshots/15318458/media/ece706ba65c6ddc1d1c0c94f6c6c4702.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Apartment title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <!-- button -->
            <router-link
                class="btn btn-dark"
                :to="{ name: 'apartments.show' }"
            >
                Vedi dettaglio appartamento
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