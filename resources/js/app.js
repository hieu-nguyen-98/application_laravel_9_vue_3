import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createRouter, createWebHistory } from 'vue-router';
import VueSweetalert2 from 'vue-sweetalert2';

import Home from './Home.vue';
import Routes from './routes/index.js';

const app = createApp(Home);

const router = createRouter({
    history: createWebHistory('/'),
    routes: Routes,
});

app.use(VueSweetalert2);
app.use(router);
app.mount('#app');