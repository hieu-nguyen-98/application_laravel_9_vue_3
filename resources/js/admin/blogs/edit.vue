<script setup>
    import { Form } from 'vee-validate';
    import axios from 'axios';
    import { reactive, onMounted, ref } from 'vue';
    import flatpickr from "flatpickr";
    import 'flatpickr/dist/themes/light.css';
    import { useRouter, useRoute } from 'vue-router';
    import Swal from 'sweetalert2';

    const form = reactive({
        meta_title: '',
        title: '',
        content: '',
        image: null,
        image_title: '',
        date: '',
        description: '',
        selectedImageFile : null,
    });

    const formattedDate = (inputDate) => {
        const date = new Date(inputDate);
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        const period = hours < 12 ? 'AM' : 'PM';
        const formattedTime = `${hours % 12}:${minutes} ${period}`;

        return `${year}-${month}-${day} ${formattedTime}`;
    }

    const router = useRouter();
    const route = useRoute();
    const editBlog = () => {
        axios.get(`/api/blogs/${route.params.id}/edit`)
        .then(({data}) => {
            form.meta_title = data.meta_title;
            form.title = data.title;
            form.content = data.content;
            form.image = data.image;
            form.image_title = data.image_title;
            form.date = formattedDate(data.date);
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

    const updateProduct = (values, actions) => {
        if(form.selectedImageFile == null){
            form.selectedImageFile  = form.image
        }
        const formData = new FormData();
        formData.append('meta_title', form.meta_title);
        formData.append('title', form.title);
        formData.append('content', form.content);
        formData.append('image_title', form.image_title);
        formData.append('date', form.date);
        formData.append('description', form.description);
        formData.append('image', form.selectedImageFile);
        axios.post(`/api/blogs/${route.params.id}/edit`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        .then((response) => {
            router.push('/admin/blogs');
            Swal.fire('success', 'Blog updated successfully!', 'success');
        })
        .catch((error) => {
            actions.setErrors(error.response.data.errors);
        })
    };

    onMounted(() => {
        flatpickr(".flatpickr", {
            enableTime: true,
            dateFormat: "Y-m-d h:i K",
            defaultHour: 10,
        });
        if (route.name === 'admin.blogs.edit') {
            editBlog();
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
                        Blog
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/admin/dashboard">Home</router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <router-link to="/admin/blogs">Blog</router-link>
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
                                            <label for="meta_title">Meta title</label>
                                            <input 
                                                v-model="form.meta_title" 
                                                type="text" 
                                                class="form-control" 
                                                :class="{ 'is-invalid': errors.meta_title }"
                                                placeholder="Enter Meta title">
                                            <span class="invalid-feedback">{{ errors.meta_title }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input 
                                                v-model="form.title" 
                                                type="text" 
                                                class="form-control" 
                                                :class="{ 'is-invalid': errors.title }"
                                                placeholder="Enter title">
                                            <span class="invalid-feedback">{{ errors.title }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <br>
                                            <input ref="fileInput" type="file" class="d-none" @change="previewImage" />
                                            <img @click="openFileInput" class="profile-user-img img-circle" :src="form.image ? form.image : '/noimage.png'" alt="Product profile picture">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input 
                                                v-model="form.date" 
                                                type="text" 
                                                class="form-control flatpickr" 
                                                :class="{ 'is-invalid': errors.date }"
                                                placeholder="Enter Date">
                                            <span class="invalid-feedback">{{ errors.date }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p class="invalid-feedback">{{ errors.image }}</p> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image_title">Image Title</label>
                                            <input 
                                                v-model="form.image_title" 
                                                type="text" 
                                                class="form-control" 
                                                :class="{ 'is-invalid': errors.image_title }"
                                                placeholder="Enter Image title">
                                            <span class="invalid-feedback">{{ errors.image_title }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <input 
                                                v-model="form.content" 
                                                type="text" 
                                                class="form-control" 
                                                :class="{ 'is-invalid': errors.content }"
                                                placeholder="Enter Content">
                                            <span class="invalid-feedback">{{ errors.content }}</span>
                                        </div>
                                    </div>
                                </div>
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