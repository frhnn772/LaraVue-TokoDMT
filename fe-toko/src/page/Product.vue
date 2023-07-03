<template>
    <div class="container mt-5">
        <div class="row mt-4">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <router-link :to="{name: 'page.index'}" class="text-dark">Home</router-link>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Produk</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row mb-4">
                <div class="col-md-4 mt-4" v-for="(produk, index) in produks.data" :key="index">
                    <div class="card shadow card-product" >
                        <img :src="'example-product.jpg'" style="object-fit: cover; height:230px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{produk.produk}}</h5>
                            <p class="card-text">Harga : {{produk.harga}}</p>
                            <!-- <router-link
                                            :to="{name: 'pembeli.edit', params:{id: pembeli.id}}"
                                            class="btn btn-sm btn-outline-info"
                                        >Edit</router-link> -->
                            <router-link class="btn btn-outline-success btn-sm" :to="{name: 'page.product.productdetails', params:{id: produk.id_produk}}"><i class="bi bi-cart-plus-fill"></i> Pesan</router-link>
                        </div>
                    </div>
                </div>
                
            </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import {onMounted, ref} from 'vue'

export default {
    setup() {
        // reactive state
        let produks = ref([]);

        onMounted(() => {
            // get data from api endpoint
            axios.get('http://127.0.0.1:8000/api/produk')
            .then((result) => {
                produks.value = result.data
            }).catch((err) => {
                console.log(err.response)
            });
        });
        
    return {
        produks,
    }
    }
}
</script>
