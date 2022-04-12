<template>
  <div>
    <TheNavbar></TheNavbar>

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

}
</script>

<style>

</style>