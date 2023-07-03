<template>
    <div class="container mt-5">
        <router-link class="btn btn-outline-success btn-sm mb-3" :to="{name: 'page.admin.create'}">Tambah Produk</router-link>
        <router-link class="btn btn-outline-info btn-sm mx-2 mb-3" :to="{name: 'page.admin.pembeli'}">Data Pembeli</router-link>
        <div class="card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID Produk</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(produk, index) in produks.data" :key="index">
                                <td>{{produk.index}}</td>
                                <td>{{produk.id_produk}}</td>
                                <td>{{produk.produk}}</td>
                                <td>{{produk.deskripsi}}</td>
                                <td>{{produk.harga}}</td>
                                <td>{{produk.kategori}}</td>
                                <td>
                                    <div class="btn-group">
                                        <router-link
                                        :to="{name: 'page.admin.edit', params:{id: produk.id_produk}}"
                                            class="btn btn-sm btn-outline-info"
                                        >Edit</router-link>
                                        <button @click="destroy(produk.id_produk, index, produk.produk)" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>

                </tbody>
            </table>
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
        function destroy(id, index, nmProduk) {
            if (window.confirm(`Yakin ingin hapus produk ${nmProduk} ?`)) {
            axios.delete(
                `http://127.0.0.1:8000/api/produk/${id}`
            )
            .then(() => {
                produks.value.data.splice(index, 1)
            }).catch((err) => {
                console.log(err.response.data);
            });
            }
        }
        
        
    return {
        produks,
        destroy
    }
    }
}
</script>