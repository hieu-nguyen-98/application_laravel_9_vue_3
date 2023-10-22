import Dashboard from '../admin/Dashboard.vue';
import ListAppointments from '../admin/appointments/index.vue';
import CreateAppointments from '../admin/appointments/create.vue';
import EditAppointments from '../admin/appointments/edit.vue';
import ListUsers from '../admin/users/index.vue';
import ListSettings from '../admin/settings/index.vue';
import ListProfiles from '../admin/profiles/index.vue';
import ListProducts from '../admin/products/index.vue';
import CreateProducts from '../admin/products/create.vue';
import EditProducts from '../admin/products/edit.vue';
import ListBlogs from '../admin/blogs/index.vue';
import CreateBlogs from '../admin/blogs/create.vue';
import EditBlogs from '../admin/blogs/edit.vue';

import Login from '../admin/auth/Login.vue';

export default [
    {
        path: '/admin/login',
        name: 'admin.login',
        component: Login,
    },
    {
      path: '/admin/dashboard',
      name: 'admin.dashboard',
      component: Dashboard,
    },
    {
      path: '/admin/appointments',
      name: 'admin.appointments',
      component: ListAppointments,
    },
    {
      path: '/admin/appointments/create',
      name: 'admin.appointments.create',
      component: CreateAppointments,
    },
    {
      path: '/admin/appointments/:id/edit',
      name: 'admin.appointments.edit',
      component: EditAppointments,
    },
    {
      path: '/admin/users',
      name: 'admin.users',
      component: ListUsers,
    },
    {
      path: '/admin/settings', // Corrected path
      name: 'admin.settings',
      component: ListSettings,
    },
    {
      path: '/admin/profiles',
      name: 'admin.profiles',
      component: ListProfiles,
    },
    {
      path: '/admin/products',
      name: 'admin.products',
      component: ListProducts,
    },
    {
      path: '/admin/products/create',
      name: 'admin.products.create',
      component: CreateProducts,
    },
    {
      path: '/admin/products/:id/edit',
      name: 'admin.products.edit',
      component: EditProducts,
    },
    {
      path: '/admin/blogs',
      name: 'admin.blogs',
      component: ListBlogs,
    },
    {
      path: '/admin/blogs/create',
      name: 'admin.blogs.create',
      component: CreateBlogs,
    },
    {
      path: '/admin/blogs/:id/edit',
      name: 'admin.blogs.edit',
      component: EditBlogs,
    },
];