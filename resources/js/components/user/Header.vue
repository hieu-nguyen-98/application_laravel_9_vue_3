<script setup>
    import { Form } from 'vee-validate';
    import { reactive, onMounted, ref, createApp } from 'vue';
    import flatpickr from "flatpickr";
    import 'flatpickr/dist/themes/light.css';
    import Swal from 'sweetalert2';

    const form = reactive({
        client_name : '',
        phone : '',
        start_time : '',
        end_time : '',
        description : '',
        title : '',
    })

    const createOrder = (values, actions) => {
        axios.post('/api/createOrder', form)
        .then((response) => {
            Swal.fire('Đặt hàng thành công!', 'Chúng tôi sẽ sơm liên hệ với bạn để xác nhận đơn hàng!', 'success');
        })
        .catch((error) => {
            actions.setErrors(error.response.data.errors);
        })
    }

    onMounted(() => {
        flatpickr(".flatpickr", {
            enableTime: true,
            dateFormat: "Y-m-d h:i K",
            defaultHour: 10,
        });
    });
</script>
<template>
    <!-- header section strats -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <router-link class="navbar-brand" :to="'/'">
                    <img width="100" height="80" src="user/images/logo.jfif" alt="#" />
                </router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="'/'">
                                Trang chủ <span class="sr-only">(current)</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="'/product'">
                                Sản phẩm
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="'/table-price'">
                                Bảng giá
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="'/story'">
                                Câu chuyện
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#cancelar" data-toggle="modal" data-target="#cancelar">Đặt lịch ngay</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="contact.html">Liên hệ</a>
                        </li> -->
                        
                        <!-- <form class="form-inline">
                            <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form> -->
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- end header section -->
    <div id="cancelar" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Đặt lịch sản phẩm</h4>
                </div>
                <div class="modal-body">
                    <Form @submit="createOrder" v-slot:default="{ errors }">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Tên Khách Hàng</label>
                                <input 
                                    v-model="form.client_name" 
                                    type="text" 
                                    class="form-control"
                                    :class="{'is-invalid': errors.client_name}" 
                                >
                                <span class="text-danger">{{ errors.client_name}}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Số điện thoại</label>
                                <input 
                                    v-model="form.phone" 
                                    type="text" 
                                    class="form-control" 
                                    :class="{'is-invalid': errors.phone}" 
                                >
                                <span class="text-danger">{{ errors.phone}}</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="phone">Ngày đặt hàng</label>
                                <input 
                                    type="text" 
                                    v-model="form.start_time" 
                                    :class="{'is-invalid': errors.start_time}"
                                    class="form-control flatpickr"
                                >
                                <span class="text-danger">{{ errors.start_time}}</span>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Ngày nhận hàng</label>
                                <input 
                                    type="text" 
                                    v-model="form.end_time" 
                                    :class="{'is-invalid': errors.end_time}" 
                                    class="form-control flatpickr"
                                >
                                <span class="text-danger">{{ errors.end_time}}</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="name">Địa chỉ giao hàng</label>
                                <input 
                                    v-model="form.description" 
                                    type="text" 
                                    class="form-control" 
                                    :class="{'is-invalid': errors.description}" 
                                >
                                <span class="text-danger">{{ errors.description}}</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="name">Thông tin đơn hàng</label>
                                <input 
                                    v-model="form.title" 
                                    type="text" 
                                    :class="{'is-invalid': errors.title}" 
                                >
                                <span class="text-danger">{{ errors.title}}</span>
                            </div>
                        </div>
                        <div class="mt-2 text-center">
                            <button type="submit" class="btn btn-success">Xác nhận đặt hàng</button>
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    </div>

</template>
<style scoped>
.modal-dialog.modal-lg {
    margin-top: 15rem;
}</style>