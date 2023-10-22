<script setup>
import Header from './components/admin/Header.vue';
import Siderbar from './components/admin/Siderbar.vue';
import Footer from './components/admin/Footer.vue';
import Setting from './components/admin/Settings.vue';
</script>
<template>
    <div id="app">
        <div class="wrapper">
            <Header />
            <Siderbar />
            <div class="content-wrapper">
                <router-view></router-view>
            </div>
            <Footer />
            <Setting />
        </div>
    </div>
</template>