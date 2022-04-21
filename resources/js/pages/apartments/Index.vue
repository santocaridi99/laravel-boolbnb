<template>
  <div class="container">
      <!-- lista degli appartamenti filtrati -->
      <h1 class="my-4 text-center">Qui lista filtrata degli appartamenti</h1>

      <!-- cards -->
      <div class="d-flex d-flex justify-content-center align-items-center flex-wrap">
        <ApartmentCard></ApartmentCard>
        <div v-for="(luoghi,i) in provaluoghi" :key="luoghi + i">
          {{luoghi.address.freeformAddress}}
        </div>
      </div>
  </div>
</template>

<script>
import ApartmentCard from '../../components/ApartmentCard.vue'
export default {
  components: {
    ApartmentCard
  },
  props:{
    provaluoghi:Array,
     
  },
  data(){
    return{
    }
  }

}
</script>

<style>

</style>