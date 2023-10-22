<script setup>
    import { Form } from 'vee-validate';
    import axios from 'axios';
    import { reactive, onMounted, ref } from 'vue';
    import 'flatpickr/dist/themes/light.css';
    import { useRouter, useRoute } from 'vue-router';
    import Swal from 'sweetalert2';

    const form = reactive({
        name: '',
        image: null,
        price: '',
        description: '',
        selectedImageFile : null,
    });

    const router = useRouter();
    const route = useRoute();
    const editProduct = () => {
        axios.get(`/api/products/${route.params.id}/edit`)
        .then(({data}) => {
            form.name = data.name;
            form.image = data.image;
            form.price = data.price;
            form.description = data.description;
        })
    };

    const fileInput = ref(null);
    const openFileInput = () => {
        fileInput.value.click();
    };

    const previewImage = (event) => {
        if (event.target.files.length > 0) {
            const file = event.target.files[0];
            form.image = URL.createObjectURL(file);
            form.selectedImageFile = file;
        }
    };

    const updateProduct = () => {
        const formData = new FormData();
        formData.append('name', form.name);
        formData.append('price', form.price);
        formData.append('description', form.description);
        formData.append('image', form.selectedImageFile);
        axios.post(`/api/products/${route.params.id}/edit`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        .then((response) => {
            router.push('/admin/products');
            Swal.fire('success', 'Product updated successfully!', 'success');
        })
        .catch((error) => {
            // actions.setErrors(error.response.data.errors);
        })
    };

    onMounted(() => {
        if (route.name === 'admin.products.edit') {
            editProduct();
        }
    });
</script>
<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <span>Edit</span>
                        Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/admin/dashboard">Home</router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <router-link to="/admin/products">Product</router-link>
                        </li>
                        <li class="breadcrumb-item active">
                            <span>Edit</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <Form @submit="updateProduct" v-slot:default="{ errors }">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input v-model="form.name" type="text" class="form-control" :class="{ 'is-invalid': errors.name }" id="title" placeholder="Enter Title">
                                            <span class="invalid-feedback">{{ errors.name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input 
                                                v-model="form.price" 
                                                type="number" 
                                                class="form-control" 
                                                :class="{'is-invalid': errors.price}" 
                                            >
                                            <span class="invalid-feedback">{{ errors.price }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <br>
                                        <input ref="fileInput" type="file" class="d-none" @change="previewImage" />
                                        <img @click="openFileInput" class="profile-user-img img-circle" :src="form.image ? form.image : '/noimage.png'" alt="Product profile picture">
                                    </div>
                                </div>
                                <!-- <p class="invalid-feedback">{{ errors.image }}</p> -->
                                
                                <div class="form-group mt-4">
                                    <label for="description">Description</label>
                                    <textarea v-model="form.description" class="form-control" :class="{'is-invalid': errors.description}" id="description" rows="3"
                                        placeholder="Enter Description"></textarea>
                                    <span class="invalid-feedback">{{ errors.description }}</span>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </Form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.input-group-text{
    margin-left: -29px;
    border: 0.5px solid #e9ecef;
}
</style>