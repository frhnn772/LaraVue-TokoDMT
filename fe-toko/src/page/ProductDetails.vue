<template>
  <div class="container mt-5">
    <div class="row mt-4">
      <div class="col">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link :to="{name: 'page.index'}" class="text-dark">Home</router-link>
            </li>
            <li class="breadcrumb-item">
              <router-link :to="{name: 'page.product'}" class="text-dark">Produk</router-link>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <img :src="'../../example-product.jpg'" alt="example-product" style="object-fit: cover;" class="img-fluid shadow rounded" />
      </div>
      <div class="col-md-6">
        <h2>
          <strong v-model="id_produk">{{produk.produk}}</strong>
        </h2>
        <hr />
        <h4>
          Harga :
          <strong>Rp. {{produk.harga}}</strong>
        </h4>
        <form class="mx-2 mt-2" @submit.prevent="store()">
          <div class="form-group mb-3">
            <label for="nama_pembeli">Nama</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Kamu" v-model="pembeli.nama_pembeli" />
            <div v-if="validation.id_pembeli" class="text-danger">{{ validation.nama_pembeli[0] }}</div>
          </div>
          <div class="form-group mb-3">
            <label for="jumlah_pemesanan">Jumlah Pesan</label>
            <input type="number" class="form-control" placeholder="*contoh: 3" v-model="pembeli.jumlah_beli" />
            <div v-if="validation.jumlah_beli" class="text-danger">{{ validation.jumlah_beli[0] }}</div>
          </div>
          <router-link to="/product" class="btn btn-outline-warning btn-sm">Kembali</router-link>
          <button type="submit" class="btn btn-sm btn-outline-success float-end">Pesan</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router';
import axios from 'axios';

export default {
  setup() {
    // data binding
    let produk = reactive({
      id_produk: '',
      produk: '',
      harga: ''

    });
    let pembeli = reactive({
      nama_pembeli: '',
      id_produk: '',
      jumlah_beli: ''

    });

    const validation = ref([]);
    const router = useRouter();
    const route = useRoute();

    onMounted(() => {
      axios.get(`http://127.0.0.1:8000/api/produk/${route.params.id}`)
        .then((result) => {
          produk.id_produk = result.data.data.id_produk
          produk.produk = result.data.data.produk
          produk.harga = result.data.data.harga
        }).catch((err) => {
          alert(err.getmessage)
        });
    });

    function store() {
      pembeli.id_produk = produk.id_produk
      axios.post(
        `http://127.0.0.1:8000/api/pembeli`, pembeli
      )
        .then((response) => {
          alert(`Berhasil membeli ${produk.nama_produk}`)
          router.push({
            name: 'page.index'
          });
        }).catch((err) => {
          validation.value = err.response.data.errors
        });
    }
    return {
      produk,
      pembeli,
      validation,
      router,
      store
    };
  }

}
</script>