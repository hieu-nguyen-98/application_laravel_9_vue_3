<script setup>
    import axios from 'axios';
    import { ref, onMounted, reactive, watch } from 'vue';
    import Swal from 'sweetalert2';
    import { debounce } from 'lodash';
    import  {Bootstrap4Pagination } from 'laravel-vue-pagination';

    const blogs = ref({ data: [] });    

    const startIndex = ref(0);
    const pageSize = 10;
    const searchQuery = ref(null);
    const getBlogs = (page = 1) => {
        axios.get(`/api/blogs?page=${page}`, {
            params: {
                query: searchQuery.value
            }
        })
        .then((resp) => {
            blogs.value = resp.data;
            startIndex.value = (page - 1) * pageSize;
            selectedBlogs.value = [];
            selectAll.value = false;
        });
    }

    const formatDate = (dateTime) => {
        const date = new Date(dateTime);
        const options = { year: "numeric", month: "2-digit", day: "2-digit" };
        const format = date.toLocaleDateString("en-US", options);
        return format;
    };

    const selectedBlogs = ref([]);
    const toggleSelection = (blog) => {
        const index = selectedBlogs.value.indexOf(blog.id);
        if (index == -1) {
            selectedBlogs.value.push(blog.id);
        } else {
            selectedBlogs.value.splice(index, 1);
        }
    };

    const selectAll = ref(false);
    const selectAllBlogs = () => {
        if (selectAll.value) {
            selectedBlogs.value = blogs.value.data.map(blog => blog.id);
        } else {
            selectedBlogs.value = [];
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
                axios.delete(`/api/blogs/${id}`)
                    .then((resp) => {
                        let blogsData = blogs.value.data;
                        blogsData = blogsData.filter(blog => blog.id !== id);
                        blogs.value.data = blogsData;
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
        axios.delete('/api/blogs', {
            data: {
                ids: selectedBlogs.value
            }
        })
        .then(resp => {
            blogs.value.data = blogs.value.data.filter(blog => !selectedBlogs.value.includes(blog.id));
            selectedBlogs.value = [];
            selectAll.value = false;
            Swal.fire('success', resp.data.message, 'success');
        });
    };

    watch(searchQuery, debounce(() => {
        getBlogs();
    }, 300));
    onMounted(() => {
        getBlogs();
    });
</script>
<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Blogs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blogs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <router-link to="/admin/blogs/create">
                        <button type="button" class="mb-2 btn btn-primary">
                            <i class="fa fa-plus-circle changeRolemr-1"></i>
                            Add New Blog
                        </button>
                    </router-link>
                    <div v-if="selectedBlogs.length > 0">
                        <button @click="multpDelete" type="button" class="ml-2 mb-2 btn btn-danger">
                            <i class="fa fa-trash mr-1"></i>
                            Delete
                        </button>
                        <span class="ml-2">Selected <span class="text-danger">{{ selectedBlogs.length }}</span> products</span>
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
                                <input type="checkbox" v-model="selectAll" @change="selectAllBlogs" />
                            </th>
                            <th>STT</th>
                            <th>Meta Title</th>
                            <th width="400pt">Title</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Date</th>
                            <th>View</th>
                            <th>Option</th>
                        </thead>
                        <tbody v-if="blogs.data.length > 0">
                            <tr v-for="(blog, index) in blogs.data" :key="blog.id" :blog="blog" >
                                <td>
                                    <input type="checkbox" :checked="selectAll" @change="toggleSelection(blog)"/>
                                </td>
                                <td>{{ startIndex + index + 1 }}</td>
                                <td>{{ blog.meta_title }}</td>
                                <td>{{ blog.title }}</td>
                                <td class="text-center">
                                    <img :src="blog.image" alt="{{ blog.name }}" class="product__image">
                                </td>
                                <td> {{ blog.content }}</td>
                                <td> {{ formatDate(blog.date) }} </td>
                                <td> {{ blog.view }} </td>
                                <td>
                                    <router-link :to="`/admin/blogs/${blog.id}/edit`">
                                        <i class="fa fa-edit mr-2"></i>
                                    </router-link>
                                    <a href="#" @click.prevent="deleteProduct(blog.id)">
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
            <Bootstrap4Pagination :data="blogs" @pagination-change-page="getBlogs" class="float-right"/>
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