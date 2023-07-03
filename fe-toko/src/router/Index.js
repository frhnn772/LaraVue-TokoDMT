import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'page.index',
        component: () => import("../page/Index.vue")

    },
    {
        path: '/product',
        name: 'page.product',
        component: () => import("../page/Product.vue")

    },
    {
        path: '/product/productdetails/:id',
        name: 'page.product.productdetails',
        component: () => import("../page/ProductDetails.vue")

    },
    {
        path: '/about',
        name: 'page.about',
        component: () => import("../page/About.vue")

    },
    {
        path: '/admin',
        name: 'page.admin',
        component: () => import("../page/Admin/Index.vue")

    },
    {
        path: '/admin/create',
        name: 'page.admin.create',
        component: () => import("../page/Admin/Create.vue")

    },
    {
        path: '/admin/edit/:id',
        name: 'page.admin.edit',
        component: () => import("../page/Admin/Edit.vue")

    },
    {
        path: '/admin/pembeli',
        name: 'page.admin.pembeli',
        component: () => import("../page/Admin/Customer.vue")

    }

]

const router = createRouter({
    linkActiveClass: 'active',
    history: createWebHistory(),
    routes,

})

export default router;