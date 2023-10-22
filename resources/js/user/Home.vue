<script setup>
    import axios from 'axios';
    import { ref, onMounted, reactive, watch } from 'vue';

    const products = ref({});
    const getProducts = () => {
        axios.get(`/api/getProducts`)
        .then((resp) => {
            products.value = resp.data;
        });
    }
    
    const formatNumber = (price) => {
        if (!price) return '';
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    const formValues = ref({});
    const productDetail = (product) => {
        axios.get(`/api/detailProduct/${product}`)
        .then((resp) => {
            formValues.value = resp.data;
        });
    }

    onMounted(() => {
        getProducts();
    });
</script>
<template>
    <!-- product section -->
    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Sản phẩm <span>của chúng tôi</span>
                </h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-4" v-for="(product, index) in products" :key="product.id" :product="product">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a @click.prevent="productDetail(product.id)" href="#myModal" class="option1" data-toggle="modal" data-target="#myModal">
                                    Xem nhanh
                                </a>
                                <a href="" class="option2">
                                    Đặt hàng
                                </a>
                            </div>
                        </div>
                        <div class="img-box">
                            <img :src="product.image" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ product.name }}
                            </h5>
                            <h6>
                                {{ formatNumber(product.price) }} / <span class="text-danger">1 bánh</span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-box">
                <a href="">
                    View All products
                </a>
            </div>
        </div>
    </section>
    <!-- end product section -->

    <!-- subscribe section -->
    <section class="subscribe_section">
        <div class="container-fuild">
            <div class="box">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="subscribe_form ">
                            <div class="heading_container heading_center">
                                <h3>Gian hàng hữu ích khác</h3>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end subscribe section -->

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-success">Bánh Chưng Phúc Yên</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                           <img :src="formValues.image ? formValues.image : './noimage.png'" alt="" class="quick__image">
                        </div>
                        <div class="col-6">
                            <p><span class="text-dark font-weight-bold">Tên sản phẩm : </span><span class="text-success">{{ formValues.name }}</span></p>
                            <p><span class="text-dark font-weight-bold">Trọng lượng : </span>1kg</p>
                            <p><span class="text-dark font-weight-bold">Kích thước : </span>30x30</p>
                            <p><span class="text-dark font-weight-bold">Giá : </span><span class="text-success">{{ formatNumber(formValues.price) }} / 1 Bánh</span></p>
                            <p><span class="text-dark font-weight-bold">Thông tin liên hệ : </span><span class="text-success">0352621296</span></p>
                            <p>Bánh trưng nhà làm ...............</p>
                            <button class="btn btn-danger">Đặt hàng ngay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<style scoped>
.modal-dialog.modal-lg {
    margin-top: 13%;
}
.quick__image{
    width: 100%;
    height: 100%;
}
</style>