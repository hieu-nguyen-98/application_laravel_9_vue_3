import './bootstrap';

import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import {createRouter, createWebHistory} from 'vue-router'; 
import VueSweetalert2 from 'vue-sweetalert2';
import { createPinia } from 'pinia';

import Dashboard from './Dashboard.vue';
import Routes from './routes/routes.js';
import { useAuthUserStore } from './stores/AuthUserStore';

import Login from './admin/auth/Login.vue';

const app = createApp(Dashboard);
const pinia = createPinia();

const router = createRouter({
    history: createWebHistory(),
    routes: Routes,
});

app.use(pinia);
app.use(VueSweetalert2);
app.use(router);
if (window.location.pathname === '/admin/login') {
    const currentApp = createApp({});
    currentApp.component('Login', Login);
    currentApp.mount('#login');
} else {
    app.mount('#app');
}