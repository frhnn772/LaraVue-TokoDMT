<template>
    <div class="container mt-5">
        <div class="card px-4 py-4">
            <form @submit.prevent="store()">
                <div class="mb-3">
                    <label for="exampleInputidproduk" class="form-label">ID Produk</label>
                    <input type="number" class="form-control" id="exampleInputidproduk"
                        placeholder="*Contoh: 001" v-model="produk.id_produk">
                        <div v-if="validation.id_produk" class="text-danger">{{ validation.id_produk[0] }}</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputnmproduk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleInputnmproduk"
                        placeholder="*contoh: Teh Tarik Uncle Muthu" v-model="produk.produk">
                        <div v-if="validation.produk" class="text-danger">{{ validation.produk[0] }}</div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="*contoh: Minuman ini dibuat dengan perpaduan biji kopi asli dan gula aren" v-model="produk.deskripsi"></textarea>
                    <div v-if="validation.deskripsi" class="text-danger">{{ validation.deskripsi[0] }}</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputhargaproduk" class="form-label">Harga Produk</label>
                    <input type="number" class="form-control" id="exampleInputhargaproduk" placeholder="*contoh: 8000" v-model="produk.harga">
                    <div v-if="validation.harga" class="text-danger text-sm">{{ validation.harga[0] }}</div>
                </div>
                <div class="mb-3">
                            <label for="" class="form-label">Kategori</label>
                            <select id="" class="form-select" v-model="produk.kategori">
                            <option selected disabled>- Pilih Kategori -</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                        <div v-if="validation.kategori" class="text-danger">{{ validation.kategori[0] }}</div>
                    </div>
                <router-link class="btn btn-outline-warning btn-sm" :to="{name: 'page.admin'}">Kembali</router-link>
                <button type="submit" class="btn btn-outline-success btn-sm float-end">Tambah Produk</button>
            </form>
        </div>
    </div>
</template>

<script>
    import {reactive, ref} from 'vue'
    import { useRouter } from 'vue-router';
    import axios from 'axios';
    
    export default {
        setup(){
            // data binding
            const produk = reactive({
                id_produk: '',
                produk: '',
                deskripsi: '',
                harga: '',
                kategori: ''
            });
    
            const validation = ref([]);
            const router = useRouter();
    
            function store() {
                axios.post(
                    'http://127.0.0.1:8000/api/produk',
                    produk
                )
                .then(() => {
                    router.push({
                        name: 'page.admin'
                    });
                }).catch((err) => {
                    validation.value = err.response.data
                });
            }
            return {
                produk,
                validation,
                router,
                store
            };
        }
        
    }
    </script>