<script setup>
    import axios from 'axios';
    import { ref, onMounted, reactive, watch } from 'vue';

    const settings = ref([]);
    const getSettings = () => {
        axios.get('/api/getSettings')
        .then((resp) => {
            settings.value = resp.data;
        });
    };  

    onMounted(() => {
        getSettings();
    });
</script>
<template>
    <div>
        
    </div>
    <!-- footer start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="full">
                        <div class="logo_footer">
                            <a href="#">
                                <img width="210" src="user/images/logo1.png" alt="#" />
                            </a>
                        </div>
                        <div class="information_f">
                            <p><strong>Địa chỉ:</strong> {{ settings.address }}</p>
                            <p><strong>Số điện thoại:</strong> {{ settings.phone_1 }}</p>
                            <p><strong>Số điện thoại:</strong> {{ settings.phone_2 }}</p>
                            <p><strong>EMAIL:</strong> {{ settings.email }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="widget_menu">
                                        <h3>Menu</h3>
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">About</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Testimonial</a></li>
                                            <li><a href="#">Blog</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget_menu">
                                        <h3>Account</h3>
                                        <ul>
                                            <li><a href="#">Account</a></li>
                                            <li><a href="#">Checkout</a></li>
                                            <li><a href="#">Login</a></li>
                                            <li><a href="#">Register</a></li>
                                            <li><a href="#">Shopping</a></li>
                                            <li><a href="#">Widget</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="widget_menu">
                                <h3>Theo dõi chúng tôi</h3>
                                <div class="information_f">
                                    <div class="icoin">
                                        <a href="https://www.facebook.com/MelodyHieuPy" target="_blank" rel="nofollow noopener" class="icon_facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="icoin">
                                        <a href="https://apps.apple.com/app/id1485962204" target="_blank" rel="nofollow noopener" class="icon_facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="icoin">
                                        <a href="https://apps.apple.com/app/id1485962204" target="_blank" rel="nofollow noopener" class="icon_facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="icoin">
                                        <a href="https://apps.apple.com/app/id1485962204" target="_blank" rel="nofollow noopener" class="icon_facebook">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
    <div class="cpy_">
        <p>© 2021 - Bánh Chưng Phúc Yên -<a href="https://html.design/"> Gian hàng thuộc khu vực Phúc Yên</a></p>
    </div>
</template>
<style scoped>
.icoin {
    width: 40px;
    height: 40px;
    display: inline-block; /* Đặt chúng thành inline-block để chúng nằm trên cùng một dòng */
    margin-right: 10px;
}
.icon_facebook {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: #fff;
    text-align: center;
    line-height: 40px;
    font-size: 30px !important;
    -webkit-box-shadow: 2px 2px 4px rgba(51,51,51,.42);
    box-shadow: 2px 2px 4px rgba(51,51,51,.42);
}
.icon_facebook i {
    line-height: 40px;
    font-size: 18px;
}
.icon_facebook i[data-v-1e446bb3] {
    line-height: 40px;
    font-size: 18px;
    width: 40px;
}
</style>