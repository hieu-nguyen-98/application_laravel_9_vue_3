<script setup>
    import Header from './components/user/Header.vue';
    import Slider from './components/user/Slider.vue';
    import Service from './components/user/Service.vue';
    import Footer from './components/user/Footer.vue';
</script>
<template>
    <div id="app">
        <!-- <div class="hero_area"> -->
            <Header />
            <!-- <Slider /> -->
        <!-- </div> -->
        <Service />
            <router-view></router-view>
        <Footer />
        <!-- <router-link to="/product">Go to Product Page</router-link>
            <router-link to="/categories">Go to Product Page</router-link>-->
    </div>
</template>