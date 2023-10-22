<script setup>
    import axios from 'axios';
    import { ref, onMounted, computed, watch } from 'vue';

    const blogs = ref({
      current_page: 1,
      data: [],
      last_page: 1,
    });
    const latestBlogs = ref({});
    const getBlogs = (page = 1) => {
        axios.get(`/api/getBlogs?page=${page}`)
        .then((resp) => {
            blogs.value = resp.data;
        });
    }

    const getBlogLatest = () => {
        axios.get(`/api/getBlogLatest`)
        .then((resp) => {
            latestBlogs.value = resp.data;
        });
    }

    const viewBlogs = ref({});
    const getBlogView = () => {
        axios.get(`/api/getBlogView`)
        .then((resp) => {
            viewBlogs.value = resp.data;
        });
    }

    const loadPage = (page) => {
      if (page >= 1 && page <= blogs.value.last_page) {
        getBlogs(page);
      }
    }
    
    const truncatedText = (text) => {
        if (text.length > 300) {
        return text.slice(0, 300) + "...";
      }
      return text;
    }
    onMounted(() => {
        getBlogs();
        getBlogLatest();
        getBlogView();
    });
</script>
<template>
    <div class="container-fluid width__story">
        <div class="row">
            <div class="col-md-8">
                <h1 class="h2 mt-20 mb-20 title">Câu chuyện</h1>
                <div class="row" v-for="(blog, index) in blogs.data" :key="blog.id" :blog="blog">
                    <div class="col-md-5 col-xs-5 s480-max">
                        <p>
                            <router-link :to="`/story/${blog.id}`"
                                title="{{blog.meta_title}}">
                                <img class="img-thumbnail thumb-tp-3"
                                    :src="blog.image"
                                    :alt="blog.meta_title"
                                >
                            </router-link>
                        </p>
                        <br>
                    </div>
                    <div class="col-md-7 col-xs-7 s480-max">
                        <h3 class="h4 mt-0 text-justify">
                            <router-link :to="`/story/${blog.id}`"
                                :title="blog.meta_title" >
                                {{blog.meta_title}}
                            </router-link >
                        </h3>
                        <div class="text-justify color-tp-4"> 
                            {{ truncatedText(blog.title) }} 
                            <router-link :to="`/story/${blog.id}`">...»</router-link>
                        </div>
                        <div class="row fs-tp-12 text-muted mt-5">
                            <div class="col-md-6 col-xs-6 col-xl-6">› Lượt xem ({{ blog.view }})</div>
                            <div class="col-md-6 col-xs-6 col-xl-6 text-right">› {{ blog.date }}</div>
                        </div>
                    </div>
                    <hr class="ln-tonphong-3">
                </div>
                <!-- Pagination Controls -->
                <div class="text-center">
                    <ul class="pagination">
                        <li class="page-item" :class="{ 'disabled': blogs.current_page === 1 }">
                          <a class="page-link" @click="loadPage(blogs.current_page - 1)" href="#">Previous</a>
                        </li>
                
                        <li class="page-item" v-for="page in blogs.last_page" :key="page" :class="{ 'active': page === blogs.current_page }">
                          <a class="page-link" @click="loadPage(page)" href="#">{{ page }}</a>
                        </li>
                
                        <li class="page-item" :class="{ 'disabled': blogs.current_page === blogs.last_page }">
                          <a class="page-link" @click="loadPage(blogs.current_page + 1)" href="#">Next</a>
                        </li>
                      </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-20">
                    <h4>
                        <a class="buying-helper-2" href="http://banhchungngon.vn/huong-dan-dat-mua-banh/"
                            title="Hướng dẫn mua hàng">
                            Hướng dẫn mua hàng
                        </a>
                    </h4>
                    <h4>
                        <a class="coupon-gift-2" href="http://banhchungngon.vn/danh-muc/qua-tang-khuyen-mai/">
                            Quà tặng, khuyến mại
                        </a>
                    </h4>
                    <h4>
                        <router-link class="view-all-2" to="/product">
                            Xem tất cả sản phẩm
                        </router-link>
                    </h4>
                    <h3 class="fw-tp-4k mt-20 mb-10">Được yêu thích</h3>
                    <div class="row clearfix s640-w50 s320-max">
                        <div class="col-sm-6 col-md-6 col-xs-3 s640-w50 s320-max">
                            <a href="http://banhchungngon.vn/san-pham/banh-chung-bo-dau/" title="Bánh chưng Bờ Đậu"><img
                                    class="img-thumbnail thumb-tp-0"
                                    src="http://banhchungngon.vn/wp-content/uploads/2015/11/banh-chung-ngon-bo-dau-thai-nguyen-480x320.jpg"
                                    alt="Bánh chưng ngon ở Bờ Đậu - Thái Nguyên"></a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xs-3 s640-w50 s320-max">
                            <a href="http://banhchungngon.vn/san-pham/banh-chung-nhan-ngot/" title="Bánh chưng ngọt"><img
                                    class="img-thumbnail thumb-tp-0"
                                    src="http://banhchungngon.vn/wp-content/uploads/2015/09/banh-chung-duong-ngot-ngon-480x320.jpg"
                                    alt="Bánh chưng nhân đường, ngọt, ngon"></a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xs-3 s640-w50 s320-max">
                            <a href="http://banhchungngon.vn/san-pham/banh-chung-gu-ha-giang/"
                                title="Bánh chưng gù – Xanh"><img class="img-thumbnail thumb-tp-0"
                                    src="http://banhchungngon.vn/wp-content/uploads/2018/08/mua-banh-chung-gu-ha-giang-480x320.jpg"
                                    alt="Bánh chưng gù Hà Giang được bán tại các thành phố như Hà Nội, TPHCM, Hải Phong..."></a>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xs-3 s640-w50 s320-max">
                            <a href="http://banhchungngon.vn/san-pham/banh-chung-nep-cam/" title="Bánh chưng nếp cẩm"><img
                                    class="img-thumbnail thumb-tp-0"
                                    src="http://banhchungngon.vn/wp-content/uploads/2015/02/banh-chung-nep-cam-mua-o-dau-ngon-480x320.jpg"
                                    alt="Bánh chưng nếp cẩm mua ở đâu ngon? Bạn hãy đến với cửa hàng bánh chưng ngon"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-xs-6 s640-max">
                            <h3 class="fw-tp-4k mt-20 mb-10">Bài xem nhiều</h3>
                            <ul class="lst-tonphong-0">
                                <li v-for="(view, index) in viewBlogs" :key="view.id">
                                    <router-link class="color-tp-5"
                                        :to="`/story/${view.id}`"
                                        :title="view.meta_title"
                                    >
                                        {{ view.meta_title }}
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12 col-xs-6 s640-max">
                            <h3 class="fw-tp-4k mt-20 mb-10">Bài mới đăng</h3>
                            <ul class="lst-tonphong-0">
                                <li v-for="(latest, index) in latestBlogs" :key="latest.id">
                                    <router-link class="color-tp-5" :to="`/story/${latest.id}`" :title="latest.meta_title">
                                        {{ latest.meta_title }}
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<style scoped>
    .title {
        color: #2d7a37;
        font-weight: bold;
    }

    .width__story {
        width: 50%;
    }

    .story__image {
        margin: auto;
    }

    .ln-tonphong-3 {
        margin-top: -1rem;
        border-top: 1px dashed #ddd;
        width: 100%;
    }

    img {
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
    }

    .text-justify {
        text-align: justify;
    }
    .color-tp-4 {
        font-size: 14px;    
    }

    .fs-tp-12 {
        font-size: 12px;
    }

    .text-muted {
        color: #777;
    }
        /* Pagination styles */
    .pagination {
        display: flex;
        justify-content: left;
        align-items: left;
        list-style: none;
        padding: 0;
    }
    
    .page-item {
        margin: 0 5px;
        list-style: none;
    }
    
    .page-link {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        background-color: #2d7a37;
        color: #fff;
        border: 1px solid #007BFF;
        border-radius: 4px;
        transition: background-color 0.3s;
    }
    
    .page-link:hover {
        background-color: #0056b3;
    }
    
    .disabled .page-link {
        background-color: #f5f5f5;
        color: #333;
        pointer-events: none;
    }
    
    .active .page-link {
        background-color: #2d7a37;
        color: #fff;
    }
</style>