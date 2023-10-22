import Home from '../user/Home.vue';
import TablePrice from '../user/table-price/index.vue';
import Story from '../user/story/index.vue';
import ShowStory from '../user/story/show.vue';
import Product from '../user/product/index.vue';
import showOrder from '../user/product/showOrder.vue';
import Categories from '../components/Category.vue';

export default[
    {
        path : '/',
        name : 'home',
        component : Home,
    },
    {
        path: '/product', 
        name: 'user.product', // Đặt tên cho route con
        component: Product,
    },
    {
        path: '/product/:id', 
        name: 'user.showOrder', // Đặt tên cho route con
        component: showOrder,
    },
    {
        path: '/categories', 
        name: 'user.categories', // Đặt tên cho route con
        component: Categories,
    },
    {
        path : '/table-price',
        name : 'user.table-price',
        component : TablePrice,
    },
    {
        path : '/story',
        name : 'user.story',
        component : Story,
    },
    {
        path : '/story/:id',
        name : 'user.show',
        component : ShowStory,
    },
]