<template>
    <div class="container">
      <!-- dettagli appartamenti -->
    <h1 class="my-4 text-center"> Qui dettagli appartamento</h1>
    <p class="mb-2 text-center">Tutti i dettagli dell'appartamento, tra cui:</p>
    <div class="d-flex justify-content-center align-items-center">
      <router-link
        class="btn btn-dark"
        :to="{ name: 'messages.index' }"
      >
        Contatta l'Host
      </router-link>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style></style>
