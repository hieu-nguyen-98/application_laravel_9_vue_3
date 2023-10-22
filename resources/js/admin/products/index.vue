<script setup>
    import axios from 'axios';
    import { ref, onMounted, reactive, watch } from 'vue';
    import Swal from 'sweetalert2';
    import { debounce } from 'lodash';
    import  {Bootstrap4Pagination } from 'laravel-vue-pagination';

    const products = ref({ data: [] });    

    const startIndex = ref(0);
    const pageSize = 10;
    const searchQuery = ref(null);
    const getProducts = (page = 1) => {
        axios.get(`/api/products?page=${page}`, {
            params: {
                query: searchQuery.value
            }
        })
        .then((resp) => {
            products.value = resp.data;
            startIndex.value = (page - 1) * pageSize;
            selectedProducts.value = [];
            selectAll.value = false;
        });
    }
    
    const formatNumber = (price) => {
        if (!price) return '';
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    const selectedProducts = ref([]);
    const toggleSelection = (product) => {
        const index = selectedProducts.value.indexOf(product.id);
        if (index == -1) {
            selectedProducts.value.push(product.id);
        } else {
            selectedProducts.value.splice(index, 1);
        }
    };

    const selectAll = ref(false);
    const selectAllProducts = () => {
        if (selectAll.value) {
            selectedProducts.value = products.value.data.map(product => product.id);
        } else {
            selectedProducts.value = [];
        }
    }

    const deleteProduct = (id) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/products/${id}`)
                    .then((resp) => {
                        let productsData = products.value.data;
                        productsData = productsData.filter(product => product.id !== id);
                        products.value.data = productsData;
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    })
                    .catch((error) => {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the product.',
                            'error'
                        )
                    }); 
            }
        })
    };

    const multpDelete = () => {
        axios.delete('/api/products', {
            data: {
                ids: selectedProducts.value
            }
        })
        .then(resp => {
            products.value.data = products.value.data.filter(product => !selectedProducts.value.includes(product.id));
            selectedProducts.value = [];
            selectAll.value = false;
            Swal.fire('success', resp.data.message, 'success');
        });
    };

    watch(searchQuery, debounce(() => {
        getProducts();
    }, 300));
    onMounted(() => {
        getProducts();
    });
</script>
<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <router-link to="/admin/products/create">
                        <button type="button" class="mb-2 btn btn-primary">
                            <i class="fa fa-plus-circle changeRolemr-1"></i>
                            Add New Product
                        </button>
                    </router-link>
                    <div v-if="selectedProducts.length > 0">
                        <button @click="multpDelete" type="button" class="ml-2 mb-2 btn btn-danger">
                            <i class="fa fa-trash mr-1"></i>
                            Delete
                        </button>
                        <span class="ml-2">Selected <span class="text-danger">{{ selectedProducts.length }}</span> products</span>
                    </div>
                </div>
                <div>
                    <input type="text" v-model="searchQuery" class="form-control" placeholder="Search..." />
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>
                                <input type="checkbox" v-model="selectAll" @change="selectAllProducts" />
                            </th>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Option</th>
                        </thead>
                        <tbody v-if="products.data.length > 0">
                            <tr v-for="(product, index) in products.data" :key="product.id" :product="product" >
                                <td>
                                    <input type="checkbox" :checked="selectAll" @change="toggleSelection(product)"/>
                                </td>
                                <td>{{ startIndex + index + 1 }}</td>
                                <td>{{ product.name }}</td>
                                <td class="text-center">
                                    <img :src="product.image" alt="{{ product.name }}" class="product__image">
                                </td>
                                <td> {{ formatNumber(product.price) }} VNĐ</td>
                                <td width="650pt"> {{ product.description }} </td>
                                
                                <td>
                                    <router-link :to="`/admin/products/${product.id}/edit`">
                                        <i class="fa fa-edit mr-2"></i>
                                    </router-link>
                                    <a href="#" @click.prevent="deleteProduct(product.id)">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <td colspan="6" class="text-center">No results found...</td>
                        </tbody>
                    </table>
                </div>
            </div>
            <Bootstrap4Pagination :data="products" @pagination-change-page="getProducts" class="float-right"/>
        </div>
    </div>
</template>
<style scoped>
.product__image{
    width: 50%;
    height: 100px;
}
.edit__option{
    cursor: pointer;
}
</style>