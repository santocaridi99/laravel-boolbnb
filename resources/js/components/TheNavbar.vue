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
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
          </ul>

          <!-- login/register area -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item d-flex">
              <a class="btn btn-outline-light mx-2" href="/login">Login</a>
              <a class="btn btn-outline-light" href="/register">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  
}
</script>

<style>

</style>