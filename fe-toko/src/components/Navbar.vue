<template>
  <nav class="navbar navbar-expand-lg bg-light navbar-light sticky-top shadow">
    <div class="container-fluid">
      <img src="src/assets/logodmt.png" style="width:60px;" class="px-2 rounded-5">
      <a class="navbar-brand d-lg-none" href="#">Drink Milk tea</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class=" navbar-nav mx-auto ">
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'page.index'}">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'page.product'}">Product</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'page.about'}">About</router-link>
          </li>
          <li class="nav-item">
          </li>
        </ul>
      <div class="my-2">
            <router-link class="nav-link" :to="{name: 'page.admin'}">Admin</router-link>
      </div>
      </div>
    </div>
  </nav>
</template>