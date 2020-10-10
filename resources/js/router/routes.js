import NotFound from "../views/errors/NotFound"
import AccessDenied from "../views/errors/AccessDenied"
import auth from '../middleware/auth'
import guest from '../middleware/guest'
import admin from "../middleware/admin";
const Home = () => import(/* webpackChunkName: "js/home" */ '../views/Home.vue');
const AppLayout = () => import(/* webpackChunkName: "js/applayout" */ '../views/layout/AppLayout.vue');
const AuthRoutes = () => import(/* webpackChunkName: "js/auth-routes" */ '../views/Auth/AuthRoutes.vue');
const DashboardIndex = () => import(/* webpackChunkName: "js/Dashboard-index" */ '../views/dashboard/DashboardIndex.vue');
const Dashboard = () => import(/* webpackChunkName: "js/Dashboard" */ '../views/dashboard/Dashboard.vue');
const AdminDashboardIndex = () => import(/* webpackChunkName: "js/admin-Dashboard-index" */ '../views/admin/AdminDashboardIndex.vue');
const AdminDashboard = () => import(/* webpackChunkName: "js/admin-Dashboard" */ '../views/admin/AdminDashboard.vue');
const AdminUser = () => import(/* webpackChunkName: "js/admin-user" */ '../views/Admin/User/AdminUser.vue');
const AdminCategory = () => import(/* webpackChunkName: "js/admin-category" */ '../views/Admin/Category/AdminCategory.vue');
const AdminProduct = () => import(/* webpackChunkName: "js/admin-product" */ '../views/Admin/Product/AdminProduct.vue');
const AdminLayout = () => import(/* webpackChunkName: "js/admin-layout" */ '../views/Admin/AdminLayout.vue');
const ProductRoutes = () => import(/* webpackChunkName: "js/products" */ '../views/Front/Product/ProductRoutes.vue');
const AdminOrderIndex = () => import(/* webpackChunkName: "js/admin-orders" */ '../views/Admin/Order/AdminOrderIndex.vue');
const AdminCommentIndex = () => import(/* webpackChunkName: "js/admin-comments" */ '../views/Admin/Comment/AdminCommentIndex.vue');
const AdminPaymentIndex = () => import(/* webpackChunkName: "js/admin-payments" */ '../views/Admin/Payment/AdminPaymentIndex.vue');
const Purchased = () => import(/* webpackChunkName: "js/Purchased" */ '../views/dashboard/Purchased.vue');
const Profile = () => import(/* webpackChunkName: "js/profile" */ '../views/dashboard/Profile.vue');
const HomeTagged = () => import(/* webpackChunkName: "js/home-tagged" */ '../views/Front/HomeTagged.vue');

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
                path: '/product/:url',
                name: 'products',
                component: ProductRoutes,
                props: true,
                meta: {
                    middleware: [auth]
                },
                children: [
                    {
                        path: ':slug',
                        name: 'product-show'
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
                path: 'profile/:url',
                name: 'profile',
                component: Profile,
                props: true,
                meta: {
                    middleware: [
                        auth
                    ]
                },
            },
            {
                path: '/dashboard',
                component: Dashboard,
                meta: {
                    middleware: [
                        auth
                    ]
                },
                children: [
                    {
                        path: 'index',
                        name: 'dashboard-index',
                        component: DashboardIndex,
                    },

                ]
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