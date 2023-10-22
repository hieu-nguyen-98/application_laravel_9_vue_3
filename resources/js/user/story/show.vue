<script setup>
    import axios from 'axios';
    import { ref, onMounted, computed, watch } from 'vue';
    import { useRouter, useRoute } from 'vue-router';

    const latestBlogs = ref({});
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
    const route = useRoute();
    const formValues = ref({});
    const blogDetail = () => {
        axios.get(`/api/detailBlog/${route.params.id}`)
        .then((resp) => {
            console.log(resp)
            formValues.value = resp.data;
        });
    }
    const formatDate = (datekey) =>{
        const date = new Date(datekey);
        const options = { year: "numeric", month: "2-digit", day: "2-digit" };
        const dateFormat = date.toLocaleDateString("en-US", options);
        return dateFormat;
    }
    onMounted(() => {
        getBlogLatest();
        getBlogView();
        if (route.name === 'user.show') {
            blogDetail();
        }
    });
</script>
<template>
    <div class="container-fluid width__story">
        <div class="row">
            <div class="col-md-8">
                <h1 class="h3 mt-20">{{ formValues.meta_title }}</h1>
                <div class="socials-share">
                    <div id="fb-root" class=" fb_reset">
                        <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
                            <div></div>
                        </div>
                    </div>
                    <div class="fb-like fb_iframe_widget"
                        data-href="http://banhchungngon.vn/banh-nghe-thai-binh-mon-qua-que-gay-nghien-tu-mien-que-huong-lua/"
                        data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"
                        fb-xfbml-state="rendered"
                        fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=0&amp;href=http%3A%2F%2Fbanhchungngon.vn%2Fbanh-nghe-thai-binh-mon-qua-que-gay-nghien-tu-mien-que-huong-lua%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=false">
                        <span style="vertical-align: bottom; width: 150px; height: 28px;">
                            <iframe name="f3ece361ef19ed8"
                                width="1000px" height="1000px" data-testid="fb:like Facebook Social Plugin"
                                title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true"
                                allowfullscreen="true" scrolling="no" allow="encrypted-media"
                                src="https://www.facebook.com/v2.8/plugins/like.php?action=like&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dfb907e744f6e88%26domain%3Dbanhchungngon.vn%26is_canvas%3Dfalse%26origin%3Dhttp%253A%252F%252Fbanhchungngon.vn%252Ffb914e3a8587ac%26relation%3Dparent.parent&amp;container_width=0&amp;href=http%3A%2F%2Fbanhchungngon.vn%2Fbanh-nghe-thai-binh-mon-qua-que-gay-nghien-tu-mien-que-huong-lua%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=false"
                                style="border: none; visibility: visible; width: 150px; height: 28px;"
                                class="">
                            </iframe>
                        </span>
                    </div>
                    <div>
                        <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true"
                            allowfullscreen="true"
                            class="twitter-share-button twitter-share-button-rendered twitter-tweet-button"
                            style="position: static; visibility: visible; width: 73px; height: 20px;"
                            title="Twitter Tweet Button"
                            src="https://platform.twitter.com/widgets/tweet_button.d37472b4a6622d0b1fff46ad904f6896.vi.html#dnt=false&amp;id=twitter-widget-0&amp;lang=vi&amp;original_referer=http%3A%2F%2Fbanhchungngon.vn%2Fbanh-nghe-thai-binh-mon-qua-que-gay-nghien-tu-mien-que-huong-lua%2F&amp;size=m&amp;text=B%C3%A1nh%20ngh%E1%BB%87%20-%20M%C3%B3n%20qu%C3%A0%20ngon%20t%E1%BB%AB%20Th%C3%A1i%20B%C3%ACnh%20%7C%20B%C3%A1nh%20Ch%C6%B0ng%20Ngon&amp;time=1697736464181&amp;type=share&amp;url=http%3A%2F%2Fbanhchungngon.vn%2Fbanh-nghe-thai-binh-mon-qua-que-gay-nghien-tu-mien-que-huong-lua%2F">
                        </iframe>
                    </div>
                    <div class="date-post">✦ {{ formatDate(formValues.date) }} ✦ <span class="fw-tp-6k">Lượt xem</span> ({{formValues.view}})</div>
                </div>
                <div class="cp-tp-1">
                    <p>
                        <strong>{{ formValues.title }}</strong>
                    </p>
                    <p> {{ formValues.content }} </p>
                    <div id="attachment_1165" style="width: 640px" class="wp-caption aligncenter"><img
                            :src="formValues.image"
                            :alt="formValues.meta_title" width="630" height="420"
                            class="size-full wp-image-1165"
                            sizes="(max-width: 630px) 100vw, 630px">
                        <p class="wp-caption-text">{{ formValues.image_title }}</p>
                    </div>
                    <p> {{ formValues.description }}</p>
                </div>
                <div class="source-referred"></div>
                <div class="relate-text">
                    <p><span class="color-tp-2">➥</span> Khi bạn muốn thưởng thức, sử dụng trên mâm cỗ, mâm lễ những chiếc
                        <a href="http://banhchungngon.vn" title="Cửa hàng Bánh Chưng Ngon">bánh chưng Phúc Yên</a> đậm đà văn
                        hóa truyền thống dân tộc, những chiếc bánh chưng đặc biệt như: bánh chưng nếp cẩm, <a
                            href="http://banhchungngon.vn/san-pham/banh-chung-gac-ngon/" title="Mua bánh chưng gấc">bánh
                            chưng gấc</a>, bánh chưng cốm... Bánh chưng từ các làng nghề nổi tiếng như Bờ Đậu, Tranh Khúc,
                        Lỗ Khê...
                    </p>
                    <p><span class="color-tp-2">☎</span> Gọi hotline <strong><a href="tel:+035261297">035261297</a></strong> để đặt mua. Bánh chưng Phúc Yên sẽ được đưa đến bạn.!</p>
                    <p><span class="color-tp-2">❖</span> Địa chỉ Cửa hàng Bánh Chưng Phúc Yên tại số nhà 96b, tổ 7, phường trưng nhị, Phúc Yên - Vĩnh Phúc</p>
                </div>
                <!-- <div class="tp-tags">
                    <a href="http://banhchungngon.vn/tag/banh-gian-di-ma-ngon/" rel="tag">bánh giản dị mà
                        ngon</a><a href="http://banhchungngon.vn/tag/banh-nghe-que-lua-thai-binh/" rel="tag">Bánh nghệ quê
                        lúa Thái Bình</a><a href="http://banhchungngon.vn/tag/banh-nghe-thai-binh/" rel="tag">bánh nghệ thái
                        bình</a><a href="http://banhchungngon.vn/tag/cach-lam-banh-nghe-thai-binh/" rel="tag">cách làm bánh
                        nghệ thái bình</a><a href="http://banhchungngon.vn/tag/mon-an-dac-san-thai-binh/" rel="tag">món ăn
                        đặc sản Thái Bình</a><a href="http://banhchungngon.vn/tag/mon-ngon-nen-thu-va-mua-lam-qua/"
                        rel="tag">món ngon nên thử và mua làm quà</a><a
                        href="http://banhchungngon.vn/tag/mon-qua-que-dan-da/" rel="tag">Món quà quê dân dã</a><a
                        href="http://banhchungngon.vn/tag/mon-qua-que-gay-nghien/" rel="tag">món quà quê gây nghiện</a><a
                        href="http://banhchungngon.vn/tag/mua-dac-san-thai-binh/" rel="tag">mua đặc sản Thái Bình</a><a
                        href="http://banhchungngon.vn/tag/qua-ngon-cho-tre-em-va-nguoi-gia/" rel="tag">quà ngon cho trẻ em
                        và người già</a><a href="http://banhchungngon.vn/tag/dac-san-cua-que-huong-lua/" rel="tag">đặc sản
                        của quê hương lúa</a><a href="http://banhchungngon.vn/tag/dac-san-lam-qua-ngon/" rel="tag">đặc sản
                        làm quà ngon</a><a href="http://banhchungngon.vn/tag/dac-san-ngon-viet-nam/" rel="tag">Đặc sản ngon
                        Việt Nam</a><a href="http://banhchungngon.vn/tag/dia-chi-mon-ngon-tu-thai-binh/" rel="tag">địa chỉ
                        món ngon từ Thái Bình</a><a href="http://banhchungngon.vn/tag/dia-chi-dac-san-thai-binh/"
                        rel="tag">địa chỉ đặc sản Thái Bình
                    </a>
                </div> -->
                <div id="other-post">
                    <h4>Các bài viết trước đó</h4>
                    <ul class="list-tp-0">
                        <li><a href="http://banhchungngon.vn/banh-cong-dac-san-huong-vi-dac-biet-tu-vung-dat-khmer/"
                                title="Bánh cống – Đặc sản hương vị đặc biệt từ vùng đất Khmer">
                                Bánh cống – Đặc sản hương vị đặc biệt từ vùng đất Khmer
                            </a>
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
                                    <a class="color-tp-5"
                                        :href="`/story/${view.id}`"
                                        :title="view.meta_title"
                                    >
                                        {{ view.meta_title }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12 col-xs-6 s640-max">
                            <h3 class="fw-tp-4k mt-20 mb-10">Bài mới đăng</h3>
                            <ul class="lst-tonphong-0">
                                <li v-for="(latest, index) in latestBlogs" :key="latest.id">
                                    <a class="color-tp-5" :href="`/story/${latest.id}`" :title="latest.meta_title">
                                        {{ latest.meta_title }}
                                    </a>
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
    .width__story {
        width: 50%;
    }
    .socials-share {
        position: relative;
        padding: 9px 0 3px;
        border-bottom: 1px dashed #eee;
        border-top: 1px dashed #eee;
        margin-bottom: 10px;
    }
    .socials-share div {
        display: inline-block;
        padding: 0!important;
        margin: 0!important;
        vertical-align: text-bottom;
        height: 24px!important;
    }
</style>