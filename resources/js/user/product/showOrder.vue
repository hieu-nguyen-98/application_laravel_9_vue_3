<script setup>
    import axios from 'axios';
    import { ref, onMounted, computed, watch } from 'vue';
    import { useRouter, useRoute } from 'vue-router';

    const route = useRoute();
    const formValues = ref({});
    const productDetail = () => {
        axios.get(`/api/detailProduct/${route.params.id}`)
        .then((resp) => {
            console.log(resp)
            formValues.value = resp.data;
        });
    }

    const formatNumber = (price) => {
        if (!price) return '';
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    onMounted(() => {
        if (route.name === 'user.showOrder') {
            productDetail();
        }
    });
</script>
<template>
    <div id="product-info" class="tonphong-product mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p>
                        <img class="img-thumbnail img-full"
                            :src="formValues.image"
                            :alt="formValues.name">
                        </p>
                </div>
                <div class="col-md-4">
                    <h1 class="h3 mt-0 color-tp-2 mb-0">{{ formValues.name }}</h1>
                    <div class="mt-10 intro">Bánh chưng nếp cẩm được gói từ nếp cẩm núi rừng Tây Bắc, có hương vị rất riêng,
                        bánh ngon mà không quá dẻo nên ăn nhiều không cảm thấy ngán hay nóng bụng. <span
                            class="fs-tp-13 text-muted">(≃ 1.05 kg)</span></div>
                    <div class="tit-1">Giá bán: <span class="color-tp-2 fs-tp-18">{{ formatNumber(formValues.price) }}<span
                                class="tp-currency">đ</span><span class="tp-unit">/Chiếc</span></span></div>
                    <h5 class="tit-1">Gọi mua hàng</h5>
                    <div class="high-light-1">
                        <span class="des-1 fw-tp-6k">Cửa hàng Bánh Chưng Phúc Yên</span>
                        <span class="des-1">Điện thoại: <a class="fw-tp-6k fs-tp-15" rel="nofollow"
                                href="tel:+0352621297">035 262 1297</a></span>
                        <span class="des-1">Email: <a rel="nofollow"
                                href="mailto:nguenvanhieu250698@gmail.com">tonphongfood@gmail.com</a></span>
                        <span class="des-1">Thời gian: 7:15 - 21:45, Thứ 2 - CN</span>
                    </div>
                    <h5 class="tit-2">Khuyến mại</h5>
                    <div class="high-light-2"><span class="des-2">Mua ≥ 10 chiếc, giảm 5.000đ/chiếc.</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bgc-tonphong-0 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="mt-10">Giới thiệu</h3>
                    <div class="cp-tp-1">
                        <p>
                            <strong>
                                Bánh chưng nếp cẩm có vỏ bánh có màu đen tím như ta có thể thấy ở hạt nếp cẩm. Vỏ bánh
                                khi ăn rất mềm và dẻo, ăn vào có cảm giác thanh – mát.
                            </strong>
                        </p>
                        <p>{{formValues.description}}</p>
                    </div>
                    <div class="mt-20 socials-share">
                        <div id="fb-root" class=" fb_reset">
                            <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
                                <div></div>
                            </div>
                        </div>
                        <div class="fb-like fb_iframe_widget"
                            data-href="http://banhchungngon.vn/san-pham/banh-chung-nep-cam/" data-layout="button_count"
                            data-action="like" data-show-faces="false" data-share="true" fb-xfbml-state="rendered"
                            fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=0&amp;href=http%3A%2F%2Fbanhchungngon.vn%2Fsan-pham%2Fbanh-chung-nep-cam%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=false">
                            <span style="vertical-align: bottom; width: 150px; height: 28px;"><iframe name="f33c2ce08e47ec"
                                    width="1000px" height="1000px" data-testid="fb:like Facebook Social Plugin"
                                    title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true"
                                    allowfullscreen="true" scrolling="no" allow="encrypted-media"
                                    src="https://web.facebook.com/v2.8/plugins/like.php?action=like&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df34aa6b7f632548%26domain%3Dbanhchungngon.vn%26is_canvas%3Dfalse%26origin%3Dhttp%253A%252F%252Fbanhchungngon.vn%252Ffcca818f796418%26relation%3Dparent.parent&amp;container_width=0&amp;href=http%3A%2F%2Fbanhchungngon.vn%2Fsan-pham%2Fbanh-chung-nep-cam%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=false"
                                    style="border: none; visibility: visible; width: 150px; height: 28px;"
                                    class=""></iframe></span>
                        </div>
                        <div><iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true"
                                allowfullscreen="true"
                                class="twitter-share-button twitter-share-button-rendered twitter-tweet-button"
                                style="position: static; visibility: visible; width: 73px; height: 20px;"
                                title="Twitter Tweet Button"
                                src="https://platform.twitter.com/widgets/tweet_button.d37472b4a6622d0b1fff46ad904f6896.vi.html#dnt=false&amp;id=twitter-widget-0&amp;lang=vi&amp;original_referer=http%3A%2F%2Fbanhchungngon.vn%2Fsan-pham%2Fbanh-chung-nep-cam%2F&amp;size=m&amp;text=B%C3%A1nh%20ch%C6%B0ng%20n%E1%BA%BFp%20c%E1%BA%A9m%20%7C%20B%C3%A1nh%20Ch%C6%B0ng%20Ngon&amp;time=1697807064445&amp;type=share&amp;url=http%3A%2F%2Fbanhchungngon.vn%2Fsan-pham%2Fbanh-chung-nep-cam%2F"></iframe>
                        </div>
                        <div class="date-post">✦ <span class="fw-tp-6k">Lượt xem</span> (15705)</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mt-10">
                        <div class="brand-cross">
                            Bạn có mua thêm <a target="_blank" class="fw-tp-6k" title="Món Bánh Dầy Ngon"
                                href="">Bánh Dầy Ngon</a> không? <a target="_blank"
                                title="Truy cập để Mua Bánh Dầy Ngon" class="link" href="">➔ www.<span
                                    class="fw-tp-6k">BanhDayNgon</span>.vn</a> </div>
                        <h4><a class="buying-helper-2" href=""
                                title="Hướng dẫn mua hàng">Hướng dẫn mua hàng</a></h4>
                        <h4><a class="coupon-gift-2" href="">Quà tặng,
                                khuyến mại</a></h4>
                        <h4>
                            <router-link class="view-all-2" to="/product">
                                Xem tất cả sản phẩm
                            </router-link>
                        </h4>
                        <h3 class="fw-tp-4k mt-20 mb-10">Được yêu thích</h3>
                        <div class="row clearfix s640-w50 s320-max">
                            <div class="col-sm-6 col-md-6 col-xs-3 s640-w50 s320-max">
                                <a href="" title="Bánh chưng Bờ Đậu"><img
                                        class="img-thumbnail thumb-tp-0"
                                        src="http://banhchungngon.vn/wp-content/uploads/2015/11/banh-chung-ngon-bo-dau-thai-nguyen-480x320.jpg"
                                        alt="Bánh chưng ngon ở Bờ Đậu - Thái Nguyên"></a>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-3 s640-w50 s320-max">
                                <a href="" title="Bánh chưng ngọt"><img
                                        class="img-thumbnail thumb-tp-0"
                                        src="http://banhchungngon.vn/wp-content/uploads/2015/09/banh-chung-duong-ngot-ngon-480x320.jpg"
                                        alt="Bánh chưng nhân đường, ngọt, ngon"></a>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-3 s640-w50 s320-max">
                                <a href=""
                                    title="Bánh chưng gù – Xanh"><img class="img-thumbnail thumb-tp-0"
                                        src="http://banhchungngon.vn/wp-content/uploads/2018/08/mua-banh-chung-gu-ha-giang-480x320.jpg"
                                        alt="Bánh chưng gù Hà Giang được bán tại các thành phố như Hà Nội, TPHCM, Hải Phong..."></a>
                            </div>
                            <div class="col-sm-6 col-md-6 col-xs-3 s640-w50 s320-max">
                                <a href="" title="Bánh chưng nếp cẩm"><img
                                        class="img-thumbnail thumb-tp-0"
                                        src="http://banhchungngon.vn/wp-content/uploads/2015/02/banh-chung-nep-cam-mua-o-dau-ngon-480x320.jpg"
                                        alt="Bánh chưng nếp cẩm mua ở đâu ngon? Bạn hãy đến với cửa hàng bánh chưng ngon"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.tonphong-product .high-light-2 {
    line-height: 1.15;
    background: #399f48;
    border-radius: 6px;
    padding: 8px 20px 3px;
    color: #fff;
    font-size: .98em;
}
.tonphong-product .high-light-1 {
    line-height: 1.15;
    border: 1px solid #eee;
    border-radius: 6px;
    padding: 8px 20px 3px;
}
.tonphong-product .intro {
    line-height: 1.35;
    text-align: justify;
    font-size: .98em;
}
.color-tp-2 {
    color: #2d7a37;
}
.socials-share {
    margin: 5px;
    display: flex;
    position: relative;
    padding: 9px 0 3px;
    border-bottom: 1px dashed #eee;
    border-top: 1px dashed #eee;
    margin-bottom: 10px;
}
img.img-thumbnail.img-full {
    width: 100%;
    height: 100;
}
</style>