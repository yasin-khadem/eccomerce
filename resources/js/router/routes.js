import NotFound from "../views/errors/NotFound"
import AccessDenied from "../views/errors/AccessDenied"
import auth from '../middleware/auth';
import guestShowPage from '../middleware/guest-show-page';


import guest from '../middleware/guest';
import admin from "../middleware/admin";
const Home = () => import(/* webpackChunkName: "js/home" */ '../views/Home.vue');
const AppLayout = () => import(/* webpackChunkName: "js/applayout" */ '../views/layout/AppLayout.vue');
const AuthRoutes = () => import(/* webpackChunkName: "js/auth-routes" */ '../views/Auth/AuthRoutes.vue');
const DashboardIndex = () => import(/* webpackChunkName: "js/Dashboard-index" */ '../views/dashboard/DashboardIndex.vue');
const AdminDashboardIndex = () => import(/* webpackChunkName: "js/admin-Dashboard-index" */ '../views/admin/AdminDashboardIndex.vue');
const AdminDashboard = () => import(/* webpackChunkName: "js/admin-Dashboard" */ '../views/admin/AdminDashboard.vue');
const AdminUser = () => import(/* webpackChunkName: "js/admin-user" */ '../views/Admin/User/AdminUser.vue');
const AdminCategory = () => import(/* webpackChunkName: "js/admin-category" */ '../views/Admin/Category/AdminCategory.vue');
const AdminProduct = () => import(/* webpackChunkName: "js/admin-product" */ '../views/Admin/Product/AdminProduct.vue');
const AdminLayout = () => import(/* webpackChunkName: "js/admin-layout" */ '../views/Admin/AdminLayout.vue');
const AdminOrderIndex = () => import(/* webpackChunkName: "js/admin-orders" */ '../views/Admin/Order/AdminOrderIndex.vue');
const AdminCommentIndex = () => import(/* webpackChunkName: "js/admin-comments" */ '../views/Admin/Comment/AdminCommentIndex.vue');
const AdminPaymentIndex = () => import(/* webpackChunkName: "js/admin-payments" */ '../views/Admin/Payment/AdminPaymentIndex.vue');
const Purchased = () => import(/* webpackChunkName: "js/Purchased" */ '../views/dashboard/Purchased.vue');
const ProfileShow = () => import(/* webpackChunkName: "js/profile-show" */ '../views/dashboard/ProfileShow.vue');
const HomeTagged = () => import(/* webpackChunkName: "js/home-tagged" */ '../views/Front/HomeTagged.vue');
const AboutUs = () => import(/* webpackChunkName: "js/aboutus" */ '../views/Front/AboutUs.vue');
const Show = () => import(/* webpackChunkName: "js/show" */ '../views/Front/Product/Show.vue');
const ShowGuest = () => import(/* webpackChunkName: "js/show-guest" */ '../views/Front/Product/ShowGuest.vue');
const AdminGallery = () => import(/* webpackChunkName: "js/admin-gallery" */ '../views/Admin/Gallery/AdminGallery.vue');
const ProductOrder = () => import(/* webpackChunkName: "js/product-order" */ '../views/Front/Product/ProductOrder.vue');
 

export default [
    {
        path: '/',
        component: AppLayout,
        children: [
            {
                path: '/',
                name: 'home',
                component: Home,
            },
            {
                path: '/about-us',
                name: 'about-us',
                component: AboutUs
            },
            {
                path: '/tagged/:slug',
                name: 'home-tagged',
                component: HomeTagged,
            },
            {
                path: '/purchased/index',
                name: 'purchased',
                component: Purchased,
                meta: {
                    middleware: [auth]
                }
            },
            {
                path: '/product/show-guest',
                name: 'product-show-guest',
                component: ShowGuest,
                props: true,
                // meta: {
                //     middleware: [guestShowPage]
                // },
                children: [
                    {
                        path: ':slug',
                        name: 'product-show-slug-guest'
                    }
                ]
            },
            {
                path:'/product/buy',
                name: 'product-buy',
                component: ProductOrder,
                props: true,
                meta:{
                    middleware: [auth]
                },
                children: [
                    {
                        path: ':slug',
                        name: 'product-buy-slug'
                    }
                ]
            },
            {
                path: '/product/show',
                name: 'product-show',
                component: Show,
                props: true,
                // meta: {
                //     middleware: [auth]
                // },
                children: [
                    {
                        path: ':slug',
                        name: 'product-show-slug'
                    }
                ]
            },
            {
                path: '/auth/:url',
                name: 'auth',
                props: true,
                component: AuthRoutes,
                meta: {
                    middleware: [
                        guest
                    ]
                }
            },
            {
                path: 'profile-info',
                name: 'profile',
                component: ProfileShow,
                meta: {
                    middleware: [
                        auth
                    ]
                },
            },
            {
                path: '/categories-guest',
                name: 'dashboard-index',
                component: DashboardIndex,
                meta: {
                    description:[
                        'fdsfdsfdf'
                    ]
                },
            },
            {
                path: '/admin/dashboard',
                component: AdminDashboard,
                meta: {
                    middleware: [
                        admin
                    ]
                },
                children: [
                    {
                        path: 'index',
                        name: 'admin-dashboard-index',
                        component: AdminDashboardIndex,
                    },
                ]
            },

        ]
    },
    {
        path: '/admin',
        component: AdminLayout,
        meta: {
            middleware: [
                admin
            ]
        },
        children: [
            {
                path: 'comment/index',
                name: 'admin-comment',
                component: AdminCommentIndex
            },
            {
                path: 'user/:url',
                name: 'admin-user',
                component: AdminUser,
                props: true,
                children: [
                    {
                        path: ':id',
                        name: 'admin-user-edit',
                    }

                ]
            },
            {
                path: 'gallery/:url',
                name: 'admin-gallery',
                component: AdminGallery,
                props: true,  
            },
            {
                path: 'category/:url',
                name: 'admin-category',
                component: AdminCategory,
                props: true,
                children: [
                    {
                        path: ':slug',
                        name: 'admin-category-edit',
                    }

                ]
            },
            {
                path: 'product/:url',
                name: 'admin-product',
                component: AdminProduct,
                props: true,
                children: [
                    {
                        path: ':slug',
                        name: 'admin-product-edit',
                    }

                ]
            },
            {
                path: 'order/index',
                name: 'admin-orders',
                component: AdminOrderIndex,
            },
            {
                path: 'payment/index',
                name: 'admin-payments',
                component: AdminPaymentIndex,
            }
        ]

    },
    {
        path: '*',
        name: 'not-found',
        component: NotFound
    },
    {
        path: '/404',
        name: 'error404',
        component: NotFound
    },
    {
        path: '/403',
        name: 'access-denied',
        component: AccessDenied
    }
]