<template>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid w-100 rounded-bottom" :src="'banner-1.jpg'" style="object-fit: cover; height: 490px" alt="" />
            </div>
            <div class="carousel-item">
                <img class="img-fluid w-100 rounded-bottom" :src="'banner-2.webp'" style="object-fit: cover; height: 490px" alt="" />

            </div>
            <div class="carousel-item">
                <img class="img-fluid w-100 rounded-bottom" src="src/assets/gambar.jpg" style="object-fit: cover; height: 490px" alt="" />
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>


    <div class="container my-5">
        <div class="fs-4">Best <b>Product</b>
            <router-link class="btn btn-outline-success btn-sm float-end" :to="{name: 'page.product'}"><i class="bi bi-eye-fill"></i>
                Lihat Semua</router-link>
        </div>
        <div class="container">
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
            axios.get('http://127.0.0.1:8000/api/bestproduk')
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