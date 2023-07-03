<template>
    <div class="container mt-5">
        <router-link class="btn btn-outline-warning btn-sm mx-2 mb-3" :to="{name: 'page.admin'}">Kembali</router-link>
        <div class="card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID Pembeli</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">ID Produk</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(pembeli, index) in pembelis.data" :key="index">
                                <td>{{pembeli.index}}</td>
                                <td>{{pembeli.id_pembeli}}</td>
                                <td>{{pembeli.nama_pembeli}}</td>
                                <td>{{pembeli.id_produk}}</td>
                                <td>{{pembeli.produk.produk}}</td>
                                <td>{{pembeli.jumlah_beli}}</td>
                                <td>
                                    <div class="btn-group">
                                        <!-- <router-link
                                            :to="{name: 'pembeli.edit', params:{id: pembeli.id}}"
                                            class="btn btn-sm btn-outline-info"
                                        >Edit</router-link> -->
                                        <button @click="destroy(pembeli.id_pembeli, index, pembeli.nama_pembeli)" class="btn btn-sm btn-outline-danger">Delete</button>
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
        let pembelis = ref([]);

        onMounted(() => {
            // get data from api endpoint
            axios.get('http://127.0.0.1:8000/api/pembeli')
            .then((result) => {
                pembelis.value = result.data
            }).catch((err) => {
                console.log(err.response)
            });
        });
        function destroy(id, index, nmProduk) {
             if (window.confirm(`Yakin ingin hapus orderan ${nmProduk} ?`)) {
            axios.delete(
                `http://127.0.0.1:8000/api/pembeli/${id}`
            )
            .then(() => {
                pembelis.value.data.splice(index, 1)
            }).catch((err) => {
                console.log(err.response.data);
            });
            }
        }
        
        
    return {
        pembelis,
        destroy
    }
    }
}
</script>